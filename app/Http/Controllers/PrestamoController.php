<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Cliente;
use App\Models\Cobrador;
use App\Models\Prestamo;
use App\Models\PeriodoPrestamo;
use App\Models\ClienteImagenes;
use App\Models\PrestamoCuota;
use App\Models\EstadoPrestamoCuota;

class PrestamoController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $prestamos = Prestamo::with(['cliente', 'periodo', 'prestamoCuotas' => function($cuotas){
      $cuotas->orderBy('fecha_pago_programado', 'ASC');
    }]);
    $cobrador_id = $request->get('cobrador');
    $cobrador = null;
    if(Auth::user()->hasRole('cobrador')){
      if(isset($cobrador_id) && $cobrador_id == Auth::user()->id){
        $prestamos = $prestamos->where('cobrador_id', $cobrador_id)->get();
      }else{
        return redirect('/dashboard');
      }
      
    }else{
      if(isset($cobrador_id)){
        $cobrador = Cobrador::with('user')->where('user_id', $cobrador_id)->first();
        $prestamos = $prestamos->where('cobrador_id', $cobrador_id)->get();
        
      }else{
        $prestamos = $prestamos->get();
      }
      
    }
    return view('prestamos.index', ['prestamos' => $prestamos, 'cobrador' => $cobrador]);
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
    $cobradores = Cobrador::with('user')->get();
    return view('prestamos.create', ['cliente' => $cliente, 'periodos' => $periodos, 'cobradores' => $cobradores]);
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
    $request->merge([
      'valor' => str_replace(",", "", $request->get('valor')),
    ]);
    $request->validate([
      'nombres' => 'required|max:255',
      'lastname' => 'required|max:255',
      'identificacion' => 'required|numeric',
      'cellphone' => 'required|numeric|digits_between:1,11',
      'phone' => 'numeric|digits_between:1,11',
      'address' => 'required|max:255',
      'sex' => 'required',
      'birthdate' => 'required',
      'cobrador' => 'exists:cobrador,user_id',
      'valor' => 'required|numeric|min:0',
      'interes' => 'required|numeric|min:0',
      'cuotas' => 'required|numeric|min:0',
      'periodo' => 'required',
      'inicio_prestamo' => 'required',
      'cedula-frontal' => 'required|mimes:jpg,jpeg,png|max:4096',
      'cedula-trasera' => 'required|mimes:jpg,jpeg,png|max:4096',
      'foto-cliente' => 'required|mimes:jpg,jpeg,png|max:4096',
      'foto-vivienda' => 'required|mimes:jpg,jpeg,png|max:4096',
    ]);

    $cliente = Cliente::Where('identificacion', $request->get('identificacion'))->first();
    if(is_null($cliente)){
      $cliente = new Cliente;
      $cliente->identificacion = $request->get('identificacion');
      $cliente->nombres = $request->get('nombres');
      $cliente->lastname = $request->get('lastname');
      $cliente->birthdate = $request->get('birthdate');
    }

    $cliente->cellphone = $request->get('cellphone');
    $cliente->phone = $request->get('phone');
    $cliente->address = $request->get('address');
    $cliente->sex = $request->get('sex');
    $cliente->state = 1;
    $cliente->created_at = date("Y-m-d H:i");
    $cliente->updated_at = date("Y-m-d H:i");

    $cliente->save();

    $user = Auth::user();

    $prestamo = new Prestamo;
    $prestamo->user_id = $user->id;
    $prestamo->cliente_id = $cliente->id;
    $prestamo->cobrador_id = $request->get('cobrador');
    $prestamo->valor_prestamo = $request->get('valor');
    $prestamo->tasa_interes = $request->get('interes');
    $prestamo->cuotas = $request->get('cuotas');
    $prestamo->fecha_inicio_prestamo = $request->get('inicio_prestamo');
    $prestamo->fecha_prestamo = date("Y-m-d");
    $prestamo->periodo_prestamo_id = $request->get('periodo');
    $prestamo->created_at = date("Y-m-d H:i");
    $prestamo->updated_at = date("Y-m-d H:i");
    $prestamo->usuario_creador = $user->email;

    $prestamo->save();

    
    $fecha_inicio = date("Y-m-d", strtotime($request->get('inicio_prestamo')));
    $fecha_pago = $this->getDateCuota($fecha_inicio, $prestamo->periodo_prestamo_id);
    for($i = 0; $i < $prestamo->cuotas; $i++){
      $cuota = new PrestamoCuota;
      $cuota->cliente_id = $cliente->id;
      $cuota->prestamo_id = $prestamo->id;
      $cuota->periodo_prestamo_id = $prestamo->periodo_prestamo_id;
      $cuota->user_id = $user->id;
      $estado_cuota = EstadoPrestamoCuota::where('id',1)->first();
      $cuota->estado_prestamo_cuota_id = $estado_cuota->id;
      $cuota->valor_prestamo = $prestamo->valor_prestamo;
      $cuota->tasa_interes = $prestamo->tasa_interes;
      $cuota->cuotas = $prestamo->cuotas;
      $cuota->valor_cuota = (($prestamo->valor_prestamo/$prestamo->cuotas)+(($prestamo->valor_prestamo/$prestamo->cuotas)*($prestamo->tasa_interes/100)));
      $cuota->fecha_inicio_prestamo = $prestamo->fecha_inicio_prestamo;
      $cuota->fecha_pago_programado = $fecha_pago;
      $cuota->created_at = date("Y-m-d H:i");
      $cuota->usuario_creador = $user->email;
      $cuota->save();
      $fecha_pago = $this->getDateCuota($fecha_pago, $prestamo->periodo_prestamo_id);
    }

    $cliente_imagenes = ClienteImagenes::Where('id', $cliente->id)->first();
    if(is_null($cliente_imagenes)){
      $cliente_imagenes = new ClienteImagenes;
      $cliente_imagenes->cliente_id = $cliente->id;
      $cliente_imagenes->created_at = date("Y-m-d H:i");
    }
    $cliente_imagenes->updated_at = date("Y-m-d H:i");
    if ($request->hasFile('cedula-frontal')) {
      $ID_front = $request->file('cedula-frontal')->storeAs('fotos_prestamos', $cliente->id.'-cedula-frontal.jpg');
      $cliente_imagenes->ID_front = $ID_front;
    }
    if ($request->hasFile('cedula-trasera')) {
      $ID_back = $request->file('cedula-trasera')->storeAs('fotos_prestamos', $cliente->id.'-cedula-trasera.jpg');
      $cliente_imagenes->ID_back = $ID_back;
    }
    if ($request->hasFile('foto-cliente')) {
      $person_photo = $request->file('foto-cliente')->storeAs('fotos_prestamos', $cliente->id.'-foto-cliente.jpg');
      $cliente_imagenes->person_photo = $person_photo;
    }
    if ($request->hasFile('foto-vivienda')) {
      $home_photo = $request->file('foto-vivienda')->storeAs('fotos_prestamos', $cliente->id.'-foto-vivienda.jpg');
      $cliente_imagenes->home_photo = $home_photo;
    }
    $cliente_imagenes->save();

    return redirect("/prestamos");
    
  }

  private function getDateCuota($date, $periodo_prestamo_id)
  {
    switch ($periodo_prestamo_id) {
      case 1:
        $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        break;
      case 2:
        $date = date('Y-m-d', strtotime("+7 day", strtotime($date)));
        break;
      case 3:
        $date = date('Y-m-d', strtotime("+15 day", strtotime($date)));
        break;
      case 4:
        $date = date('Y-m-d', strtotime("+30 day", strtotime($date)));
        break;
      
      default:
        $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        break;
    }
    return $date;
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