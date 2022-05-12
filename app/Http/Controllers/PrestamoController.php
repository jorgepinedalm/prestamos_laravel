<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Prestamo;
use App\Models\PeriodoPrestamo;

class PrestamoController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('prestamos.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
    $cliente = Cliente::where('identificacion', $request->get('identificacion'))->first();
    $periodos = PeriodoPrestamo::all();
    return view('prestamos.create', ['cliente' => $cliente, 'periodos' => $periodos]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    if($request->get('consulta') == 'ID'){
      return redirect()->route('prestamosCreate', 
        [
          'identificacion'=>$request->get('identificacion'),
          'valor'=>$request->get('valor'),
          'interes'=>$request->get('interes'),
          'valor'=>$request->get('valor'),
          'cuotas'=>$request->get('cuotas'),
          'periodo'=>$request->get('periodo'),
          'inicio_prestamo'=>$request->get('inicio_prestamo'),
        ]
      );
    }
    $request->validate([
      'nombres' => 'required|max:255',
      'lastname' => 'required|max:255',
      'identificacion' => 'required|numeric',
      'cellphone' => 'required|numeric|digits_between:1,11',
      'phone' => 'numeric|digits_between:1,11',
      'address' => 'required|max:255',
      'valor' => 'required|numeric|min:0',
      'interes' => 'required|numeric|min:0',
      'cuota' => 'required|numeric|min:0',
      'periodo' => 'required'
    ]);


    //dd($request);
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