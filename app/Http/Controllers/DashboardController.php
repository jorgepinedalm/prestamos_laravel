<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamoCuota;

use Auth;

class DashboardController extends Controller 
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
    $pagos = PrestamoCuota::with(['cliente', 'prestamo' => function($q){
        $q->with(['cobrador' => function($cobrador){ $cobrador->with('user');}]);
      },'periodo','estado'])->where('fecha_pago_programado', date('Y-m-d'));
    if(Auth::user()->hasRole('cobrador')){
        $pagos = $pagos->where('user_id', Auth::user()->id)->get();
    }else{
        $pagos = $pagos->get();
    }
    
    for($i = 0; $i < count($pagos); $i++){
        $pagos[$i]->saldo = PrestamoCuota::where('prestamo_id', $pagos[$i]->prestamo_id)->where('estado_prestamo_cuota_id', 1)->sum('valor_cuota');
    }
    return view('dashboard', ['pagos' => $pagos]);
  }
}