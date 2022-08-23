<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamoCuota;
use App\Models\Cobrador;
use App\Models\MedioPago;

class PrestamoCuotaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $cuotas = PrestamoCuota::with(['cliente','periodo','estado','prestamo'])->where('prestamo_id', $request->get('prestamo'));
    $cliente = $cuotas->get()[0]->cliente;
    $cobrador = Cobrador::with('user')->where('user_id', $cuotas->get()[0]->prestamo->cobrador_id)->first();
    $saldo = $cuotas->where('estado_prestamo_cuota_id', 1)->sum('valor_cuota');
    $cuotas_pagadas = $cuotas->get()->where('estado_prestamo_cuota_id', 2)->count();
    $cuotas_atrasadas = $cuotas->get()->where('estado_prestamo_cuota_id', 1)->where('fecha_pago_programado', "<", date('Y-m-d'))->count();
    return view('plan-pagos.index', [
      'cuotas' => $cuotas->paginate(15), 
      'saldo' => $saldo, 
      'cuotas_pagadas' => $cuotas_pagadas,
      'cuotas_atrasadas' => $cuotas_atrasadas,
      'cliente' => $cliente, 
      'cobrador' => $cobrador
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
    $cuota = PrestamoCuota::with(['cliente','periodo','estado','prestamo'])->where('id', $request->get('cuota'))->first();
    $cliente = $cuota->cliente;
    $cobrador = Cobrador::with('user')->where('user_id', $cuota->prestamo->cobrador_id)->first();
    $medios_de_pago = MedioPago::all();
    return view('plan-pagos.create', ['cuota' => $cuota, 'cliente' => $cliente, 'cobrador' => $cobrador, 'medios_de_pago' => $medios_de_pago]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->merge([
      'valor_pagado' => str_replace(",", "", $request->get('valor_pagado')),
    ]);
    $request->validate([
      'cuota_id' => 'exists:prestamo_cuota,id',
      'medio_de_pago' => 'exists:medio_pago,id',
      'observacion' => 'max:500',
      'valor_pagado' => 'required|numeric|min:0'
    ]);

    $cuota = PrestamoCuota::where('id', $request->get('cuota_id'))->first();
    $cuota->observacion = $request->get('observacion');
    $cuota->medio_pago_id = $request->get('medio_de_pago');

    if($request->get('valor_pagado') < $cuota->valor_cuota){
      $cuota->valor_pagado = $request->get('valor_pagado');
      $cuota->valor_cuota = $cuota->valor_cuota - $cuota->valor_pagado;
    }elseif($request->get('valor_pagado') > $cuota->valor_cuota) {
      $valor_pagado = $request->get('valor_pagado');
      $cuota->valor_pagado = $cuota->valor_cuota;
      $valor_pagado = $valor_pagado -  $cuota->valor_cuota;
      $cuotas = PrestamoCuota::where('prestamo_id', $cuota->prestamo_id)->where('id', ">", $cuota->id)->where('estado_prestamo_cuota_id', 1)->get();
      $se_pago_todo = false;
      for($i = count($cuotas)-1; $i >= 0 && !$se_pago_todo; $i--){
        if($valor_pagado <= $cuotas[$i]->valor_cuota){
          $cuotas[$i]->valor_pagado = $valor_pagado;
          $cuotas[$i]->valor_cuota = $cuotas[$i]->valor_cuota - $cuotas[$i]->valor_pagado;
          $se_pago_todo = true;
        }else{
          $cuotas[$i]->valor_pagado = $cuotas[$i]->valor_cuota;
          $valor_pagado = $valor_pagado - $cuotas[$i]->valor_cuota;
          $cuotas[$i]->estado_prestamo_cuota_id = 2;
        }
        
      }
    }else{
      $cuota->estado_prestamo_cuota_id = 2;
    }

    $cuota->save();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>