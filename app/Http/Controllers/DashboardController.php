<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestamoCuota;

class DashboardController extends Controller 
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $pagos = PrestamoCuota::with(['cliente', 'prestamo','periodo','estado'])->where('fecha_pago_programado', date('Y-m-d'))->get();
    return view('dashboard', ['pagos' => $pagos]);
  }
}