<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Prestamo;
use App\Models\PeriodoPrestamo;
use App\Models\ClienteImagenes;

class PrestamoController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $prestamos = Prestamo::all();
    return view('prestamos.index', ['prestamos' => $prestamos]);
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
      'sex' => 'required',
      'birthdate' => 'required',
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
    dd($request);

    $cliente = $cliente::Where('identificacion', $request->get('identificacion'))->first();
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
    $cliente->state = 1;
    $cliente->created_at = date("Y-m-d");
    $cliente->updated_at = date("Y-m-d");

    $cliente->save();

    $prestamo = new Prestamo;
    $prestamo->cliente_id = $cliente->id;
    $prestamo->valor_prestamo = $request->get('valor');
    $prestamo->interes = $request->get('interes');
    $prestamo->cuotas = $request->get('cuota');
    $prestamo->fecha_inicio_prestamo = $request->get('inicio_prestamo');
    $prestamo->fecha_prestamo = date("Y-m-d");
    $prestamo->periodo_prestamo_id = $request->get('periodo');
    $prestamo->created_at = date("Y-m-d");
    $prestamo->updated_at = date("Y-m-d");

    $prestamo->save();

    $cliente_imagenes = ClienteImagenes::Where('id', $cliente->id)->first();
    if(is_null($cliente_imagenes)){
      $cliente_imagenes = new ClienteImagenes;
      $cliente_imagenes->cliente_id = $cliente->id;
      $cliente_imagenes->created_at = date("Y-m-d");
    }
    $cliente_imagenes->updated_at = date("Y-m-d");
    if ($request->hasFile('cedula-frontal')) {
      $ID_front = $request->photo->storeAs('fotos_prestamos', $cliente->id.'-cedula-frontal.jpg');
      $cliente_imagenes->ID_front = $ID_front;
    }
    if ($request->hasFile('cedula-trasera')) {
      $ID_back = $request->photo->storeAs('fotos_prestamos', $cliente->id.'-cedula-trasera.jpg');
      $cliente_imagenes->ID_back = $ID_back;
    }
    if ($request->hasFile('foto-cliente')) {
      $person_photo = $request->photo->storeAs('fotos_prestamos', $cliente->id.'-foto-cliente.jpg');
      $cliente_imagenes->person_photo = $person_photo;
    }
    if ($request->hasFile('foto-vivienda')) {
      $home_photo = $request->photo->storeAs('fotos_prestamos', $cliente->id.'-foto-vivienda.jpg');
      $cliente_imagenes->home_photo = $home_photo;
    }
    $cliente_imagenes->save();

    return view('prestamos.index');
    
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