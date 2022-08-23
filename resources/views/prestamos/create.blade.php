<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de prestamo') }}
        </h2>
    </x-slot>
    <div class="text-center sticky top-0 bg-white pb-3">
        <ul class="steps">
            <li id="step-info-cliente" class="step step-primary text-xs">Información del cliente</li> 
            <li id="step-info-prestamo" class="step text-xs">Información del prestamo</li> 
            <li id="step-info-archivos" class="step text-xs">Fotografias</li>
            <li id="step-verificacion" class="step text-xs">Verificación</li>
        </ul>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="form-create" method="POST" action="/prestamos/store" enctype="multipart/form-data">
    @csrf

        <div class="content">
            <div id="content-info-cliente" class="px-6 py-4 pb-3">
                <div id="info-clientes" class="w-full md:w-1/2 mx-auto rounded-md border shadow-sm bg-white p-3">
                    <p class="mb-3">Ingrese la información del cliente</p>
                    <input type="hidden" id="consulta" name="consulta">
                    <div class="columns-1">
                        <div class="field pb-3">
                            <label for="identificacion" class="block text-sm font-bold">Identificación</label>
                            <input type="number" id="identificacion" name="identificacion" class="rounded w-full" @if(isset($cliente)) value="{{$cliente->identificacion}}" @endif onkeypress="return isNumber(event)" placeholder="Ingrese el no. de identificación del cliente" maxlength="20">
                        </div>
                    </div>
                    <div class="columns-1 lg:columns-2">
                        <div class="field pb-3">
                            <label for="firstname" class="block text-sm font-bold">Nombres</label>
                            <input type="text" id="firstname" name="nombres" class="rounded w-full" @if(isset($cliente)) readonly value="{{$cliente->nombres}}" @endif placeholder="Ingrese los nombres del cliente" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="field pb-3">
                            <label for="lastname" class="block text-sm font-bold">Apellidos</label>
                            <input type="text" id="lastname" name="lastname" class="rounded w-full" @if(isset($cliente)) readonly value="{{$cliente->lastname}}" @endif placeholder="Ingrese los apellidos del cliente" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="columns-1 lg:columns-2">
                        <div class="field pb-3">
                            <label for="cellphone" class="block text-sm font-bold">Celular</label>
                            <input type="tel" id="cellphone" name="cellphone" class="rounded w-full" @if(isset($cliente)) value="{{$cliente->cellphone}}" onkeypress="return isNumber(event)" @endif placeholder="Ej: 300 000 0000" maxlength="10" autocomplete="off" required>
                        </div>
                        <div class="field pb-3">
                            <label for="phone" class="block text-sm font-bold">Teléfono</label>
                            <input type="tel" id="phone" name="phone" class="rounded w-full" placeholder="Ej: 433 22 11" @if(isset($cliente)) value="{{$cliente->phone}}" onkeypress="return isNumber(event)" @endif maxlength="10" autocomplete="off">
                        </div>
                    </div>

                    <div class="columns-1 lg:columns-2">
                        <div class="field pb-3">
                            <label for="birthdate" class="block text-sm font-bold">Fecha de nacimiento</label>
                            <input type="date" id="birthdate" name="birthdate" class="rounded w-full" placeholder="dd/mm/yyyy" @if(isset($cliente)) value="{{$cliente->birthdate}}" readonly @endif maxlength="16" required>
                        </div>
                        <div class="field pb-3">
                            <label for="sex" class="block text-sm font-bold">Sexo</label>
                            <div class="pt-3">
                                <div class="inline-flex items-center mr-4 mb-3">
                                    <input id="sex-m" type="radio" name="sex" value="1" class="hidden" @if(isset($cliente) && $cliente->sex == 1) checked @endif required/>
                                    <label for="sex-m" class="flex items-center cursor-pointer">
                                    <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
                                    Masculino</label>
                                </div>
                                <div class="inline-flex items-center mr-4 mb-3">
                                    <input id="sex-f" type="radio" name="sex" value="0" class="hidden" @if(isset($cliente) && $cliente->sex == 0) checked @endif required/>
                                    <label for="sex-f" class="flex items-center cursor-pointer">
                                    <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
                                    Femenino</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="field pb-3">
                            <label for="address" class="block text-sm font-bold">Dirección</label>
                            <input type="text" id="address" name="address" class="rounded w-full" placeholder="Ej: Calle 1 # 01 - 01" @if(isset($cliente)) value="{{$cliente->address}}" @endif maxlength="255" required>
                    </div>
                </div>
                
            </div>
            <div id="content-info-prestamo" class="px-6 py-4 pb-3">
                <div id="info-prestamo" class="w-full md:w-1/2 mx-auto rounded-md border shadow-sm bg-white p-3">
                    <p class="mb-3">Ingrese la información del prestamo</p>
                    @if(@Auth::user()->hasRole('admin'))
                    <div class="field pb-3">
                        <label for="cobrador" class="block text-sm font-bold">Cobrador</label>
                        <select id="cobrador" name="cobrador" class="rounded w-full" required>
                            <option value="" selected disabled>Seleccione un cobrador</option>
                            @foreach ($cobradores as $cobrador)
                                <option value="{{$cobrador->user_id}}">{{$cobrador->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @elseif(@Auth::user()->hasRole('cobrador'))
                    <input type="hidden" id="cobrador" name="cobrador" value="{{@Auth::user()->id}}">
                    @endif
                    <div class="field pb-3">
                        <label for="valor" class="block text-sm font-bold">Valor a prestar</label>
                        <input type="text" id="valor" name="valor" class="rounded w-full" placeholder="Ej: 100.000 (solo números)" onkeypress="return isNumber(event)" onkeyup="currencyFormat(event)" maxlength="12" autocomplete="off" required>
                    </div>
                    <div class="columns-1 md:columns-2">
                        <div class="field pb-3">
                            <label for="periodo" class="block text-sm font-bold">Periodo de prestamo</label>
                            <select id="periodo" name="periodo" class="rounded w-full" required>
                                <option value="" selected disabled>Seleccione un periodo</option>
                                @foreach ($periodos as $periodo)
                                    <option value="{{$periodo->id}}">{{$periodo->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field pb-3">
                            <label for="cuotas" class="block text-sm font-bold">Cantidad de cuotas</label>
                            <input type="number" id="cuotas" name="cuotas" class="rounded w-full" placeholder="Ej: 1 (solo números)" maxlength="2" min="0" max="100" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="columns-1 md:columns-2">
                        <div class="field pb-3">
                            <label for="interes" class="block text-sm font-bold">Tasa de interés</label>
                            <input type="number" id="interes" name="interes" class="rounded w-full" placeholder="Ej: 5% (solo números)" maxlength="5" min="0" max="100" step=".1" autocomplete="off" required>
                        </div>
                        <div class="field pb-3">
                            <label for="inicio_prestamo" class="block text-sm font-bold">Fecha de inicio de prestamo</label>
                            <input type="date" id="inicio_prestamo" name="inicio_prestamo" class="rounded w-full" placeholder="dd/mm/yyyy" maxlength="16">
                        </div>
                    </div>
                    

                </div>
            </div>
            <div id="content-info-archivos" class="px-6 py-4 pb-3">
                <div id="info-archivos" class="w-full md:w-1/2 mx-auto rounded-md border shadow-sm bg-white p-3">
                    <p class="mb-3">Ingrese las fotos necesarias para realizar el prestamo</p>
                    <div class="field mb-3">
                        <div class="flex justify-center">
                            <div class="mb-3 w-full">
                                <label for="cedula-frontal" class="form-label inline-block mb-2 text-gray-700">Foto frontal cédula</label>
                                <input class="form-control block w-full px-3 py-1.5 text-base font-normal
                                text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                type="file" id="cedula-frontal" name="cedula-frontal" capture accept="image/*" required>
                            </div>
                        </div>    
                    </div>
                    <div class="field mb-3">
                        <div class="flex justify-center">
                            <div class="mb-3 w-full">
                                <label for="cedula-trasera" class="form-label inline-block mb-2 text-gray-700">Foto trasera cédula</label>
                                <input class="form-control block w-full px-3 py-1.5 text-base font-normal
                                text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                type="file" id="cedula-trasera" name="cedula-trasera" capture accept="image/*" required>
                            </div>
                        </div>    
                    </div>
                    <div class="field mb-3">
                        <div class="flex justify-center">
                            <div class="mb-3 w-full">
                                <label for="foto-cliente" class="form-label inline-block mb-2 text-gray-700">Foto cliente</label>
                                <input class="form-control block w-full px-3 py-1.5 text-base font-normal
                                text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                type="file" id="foto-cliente" name="foto-cliente" capture accept="image/*" required>
                            </div>
                        </div>    
                    </div>
                    <div class="field mb-3">
                        <div class="flex justify-center">
                            <div class="mb-3 w-full">
                                <label for="foto-vivienda" class="form-label inline-block mb-2 text-gray-700">Foto vivienda</label>
                                <input class="form-control block w-full px-3 py-1.5 text-base font-normal
                                text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                type="file" id="foto-vivienda" name="foto-vivienda" capture accept="image/*" required>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center px-2 py-3">
            <button id="btn-prev" type="button" class="px-3 py-2 mr-0 sm:mr-2 mb-3 sm:mb-0 rounded shadow-sm hover:shadow-lg border border-sky-500 text-sky-500 text-sm">
                <span class="fa-solid fa-chevron-left" aria-hidden="true"></span> Anterior
            </button>
            <button id="btn-next" type="button" class="px-3 py-2 mr-0 sm:mr-2 mb-3 sm:mb-0 rounded shadow-sm hover:shadow-lg border border-sky-500 bg-sky-500 text-white text-sm">
                Siguiente <span class="fa-solid fa-chevron-right" aria-hidden="true"></span> 
            </button>
            <button id="btn-save" type="submit" class="px-3 py-2 mb-3 sm:mb-0 rounded shadow-sm hover:shadow-lg border border-green-500 bg-green-500 text-white text-sm">
                <span class="fa-solid fa-floppy-disk" aria-hidden="true"></span> Guardar
            </button>
        </div>
    
    </form>
    
</x-app-layout>
<script>
    var btnPrev = document.getElementById('btn-prev');
    var btnNext = document.getElementById('btn-next');
    var btnSave = document.getElementById('btn-save');
    var stepInfoCliente = document.getElementById('step-info-cliente');
    var stepInfoPrestamo = document.getElementById('step-info-prestamo');
    var stepInfoArchivos = document.getElementById('step-verificacion');
    var stepVerificacion = document.getElementById('step-info-archivos');
    pasos = [
                {
                    step: 'step-info-cliente',
                    content: 'content-info-cliente'
                },
                {
                    step: 'step-info-prestamo',
                    content: 'content-info-prestamo'
                },
                {
                    step: 'step-info-archivos',
                    content: 'content-info-archivos'
                },
                {
                    step: 'step-verificacion'
                }
            ];
    var pasoActual = pasos[0];
    
    document.getElementById(pasoActual.step).classList.add("step-primary");
    mostrarCotenidoActual();
    
    btnPrev.style.display = 'none';
    btnSave.style.display = 'none';
    btnNext.addEventListener('click', () => {
        const indexPasoActual = pasos.indexOf(pasoActual);
        pasoActual = pasos[indexPasoActual + 1];
        document.getElementById(pasoActual.step).classList.add("step-primary");
        mostrarCotenidoActual();
        alternarBtnPrev(btnPrev);
        alternarBtnNext(btnNext);
    })
    btnPrev.addEventListener('click', () => {
        const indexPasoActual = pasos.indexOf(pasoActual);
        document.getElementById(pasoActual.step).classList.remove("step-primary");
        pasoActual = pasos[indexPasoActual - 1];
        document.getElementById(pasoActual.step).classList.add("step-primary");
        mostrarCotenidoActual();
        alternarBtnPrev(btnPrev);
        alternarBtnNext(btnNext);
    })

    function alternarBtnPrev(btnPrev){
        const indexPasoActual = pasos.indexOf(pasoActual);
        if(indexPasoActual == 0){ 
            btnPrev.style.display = 'none';
        }else{
            btnPrev.style.display = 'inline-block';
        }
    }
    function alternarBtnNext(btnNext){
        const indexPasoActual = pasos.indexOf(pasoActual);
        if(indexPasoActual == pasos.length - 1){ 
            btnNext.style.display = 'none';
            btnSave.style.display = 'inline-block';
        }else{
            btnNext.style.display = 'inline-block';
            btnSave.style.display = 'none';
        }
    }
    function ocultarTodosLosContenidos(){
        pasos.forEach(paso => {
            if(paso.content){
                document.getElementById(paso.content).classList.remove("block");
                document.getElementById(paso.content).classList.add("hidden");
            }
            
        })
    }
    function mostrarTodosLosContenidos(){
        pasos.forEach(paso => {
            if(paso.content){
                document.getElementById(paso.content).classList.remove("hidden");
                document.getElementById(paso.content).classList.add("block");
            }
            
        })
    }
    function mostrarCotenidoActual(){
        const indexPasoActual = pasos.indexOf(pasoActual);
        if(indexPasoActual == pasos.length - 1){ 
            mostrarTodosLosContenidos();
        }else{
            ocultarTodosLosContenidos();
            if(pasoActual.content){
                document.getElementById(pasoActual.content).classList.remove("hidden");
                document.getElementById(pasoActual.content).classList.add("block");
            }
            
        }
         
    }
</script>
<script>
    const fechaIncioPrestamo = document.getElementById('inicio_prestamo');
    const identificacion = document.getElementById('identificacion');
    const valor = document.getElementById('valor');
    const interes = document.getElementById('interes');
    const cuotas = document.getElementById('cuotas');
    const periodo = document.getElementById('periodo');
    const formCreate = document.getElementById('form-create');
    var hoy = new Date();
    fechaIncioPrestamo.value= [hoy.getDate() < 10 ? '0'+hoy.getDate(): hoy.getDate(), hoy.getMonth() < 10 ? '0'+(hoy.getMonth()+1) : hoy.getMonth()+1, hoy.getFullYear()].reverse().join('-');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const paramIdentificacion = urlParams.get('identificacion');
    const paramValor = urlParams.get('valor');
    const paramInteres = urlParams.get('interes');
    const paramCuotas = urlParams.get('cuotas');
    const paramPeriodo = urlParams.get('periodo');
    if(paramValor) valor.value = paramValor;
    if(paramInteres) interes.value = paramInteres;
    if(paramCuotas) cuotas.value = paramCuotas;
    if(paramPeriodo) periodo.value = paramPeriodo;
    if(paramIdentificacion){
        if(identificacion.value == null || identificacion.value == '') identificacion.value = paramIdentificacion;
        window.history.replaceState({}, document.title, "?identificacion=" + paramIdentificacion);
    }
    
    
    identificacion.addEventListener('focusout', e => {
        document.getElementById('consulta').value="ID";
        if(identificacion.value && identificacion.value != paramIdentificacion) formCreate.submit();
        
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function currencyFormat(e){
        if(e.target.value){
            e.target.value = e.target.value.replace(/,/g, '');
            e.target.value = parseFloat(e.target.value).toLocaleString('en-US');
        }
        
    }
</script>