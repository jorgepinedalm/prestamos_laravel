<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamoCuota;

class PrestamoCuotaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $cuotas = PrestamoCuota::with(['cliente','periodo','estado'])->where('prestamo_id', $request->get('prestamo'))->get();
    $cliente = $cuotas[0]->cliente;
    return view('plan-pagos.index', ['cuotas' => $cuotas, 'cliente' => $cliente]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
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