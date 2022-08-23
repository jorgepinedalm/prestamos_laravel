<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar pago a prestamo #'.$cuota->prestamo->id) }}
        </h2>
        <p class="text-secondary"><strong>Cliente:</strong> {{$cliente->nombres.' '.$cliente->lastname}}</p>
        <p class="text-secondary"><strong>Cobrador:</strong> {{$cobrador->user->name}}</p>
    </x-slot>
    <form id="form-create" method="POST" action="/plan-pagos/store" enctype="multipart/form-data">
    @csrf

        <div class="content">
            <div id="content-info-cliente" class="px-6 py-4 pb-3">
                <div id="info-clientes" class="w-full md:w-1/2 mx-auto rounded-md border shadow-sm bg-white p-3">
                        <p class="mb-3">Ingrese la información del pago a registrar</p>
                        <div class="columns-1">
                            <div class="field pb-3">
                                <label for="fecha_pago_programado" class="block text-sm font-bold">Fecha de pago de cuota</label>
                                <input type="text" id="fecha_pago_programado" name="fecha_pago_programado" class="rounded w-full" @if(isset($cuota)) value="{{date('d/m/Y',strtotime($cuota->fecha_pago_programado))}}" @endif placeholder="Ingrese la fecha de pago" maxlength="20" readonly disabled>
                                @if(date('Y-m-d',strtotime($cuota->fecha_pago_programado)) < date('Y-m-d'))
                                <small class="text-red-500 font-italic">Este pago tiene un retraso de {{round((time() - strtotime($cuota->fecha_pago_programado))/ (60 * 60 * 24)) - 1}} día(s).</small>
                                @endif
                            </div>
                            <div class="field pb-3">
                                <label for="valor_pagado" class="block text-sm font-bold">Valor a pagar</label>
                                <input type="text" id="valor_pagado" name="valor_pagado" class="rounded w-full" @if(isset($cuota)) value="{{number_format($cuota->valor_cuota,0)}}" @endif placeholder="Ingrese la fecha de pago" onkeypress="return isNumber(event)" onkeyup="currencyFormat(event)" onchange="checkDiffValue(event)" maxlength="10" readonly disabled>
                                <div class="block mt-1 text-right">
                                    <label for="valor_diferente" class="inline-flex items-center">
                                        <input id="valor_diferente" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="valor_diferente">
                                        <span class="ml-2 text-sm text-gray-600">Registrar un valor diferente</span>
                                    </label>
                                </div>
                            </div>
                            <div class="field pb-3">
                                <label for="medio_de_pago" class="block text-sm font-bold">Medio de pago</label>
                                <select id="medio_de_pago" name="medio_de_pago" class="rounded w-full">
                                    <option value="" selected disabled>Seleccione un medio de pago</option>
                                    @foreach ($medios_de_pago as $medio)
                                        <option value="{{$medio->id}}" @if($medio->id == 1 || old('medio_de_pago') == $medio->id) selected @endif>{{$medio->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field pb-3">
                                <label for="observacion" class="block text-sm font-bold">Observación <small class="font-italic">(Opcional)</small></label>
                                <textarea id="observacion" name="observacion" class="rounded w-full" rows="2" placeholder="Ingrese una observación. Máx. 500 caracteres" maxlength="500">{{old('observacion')}}</textarea>
                            </div>
                        </div>
                        <div class="text-center px-2 py-3">
                            <div id="alerta_diferencia_valor" role="alert" class="rounded bg-yellow-200 text-sm mb-3 p-2 border border-yellow-400">
                                Tenga en cuenta que ingreso un valor a pagar diferente al definido en esta cuota
                            </div>
                            <button id="btn-save" type="submit" class="px-3 py-2 mb-3 sm:mb-0 rounded shadow-sm hover:shadow-lg border border-green-500 bg-green-500 text-white text-sm">
                                <span class="fa-solid fa-floppy-disk" aria-hidden="true"></span> <strong>Registrar pago</strong>
                            </button>
                        </div>
                </div>
                
            </div>
        </div>
    </form>
    <script>
        const valor_diferente = document.getElementById('valor_diferente');
        const valor_pagado = document.getElementById('valor_pagado');
        const valor_inicial = valor_pagado.value;
        const alerta_diferencia_valor = document.getElementById('alerta_diferencia_valor');
        alerta_diferencia_valor.style.display = 'none';
        valor_diferente.addEventListener('change', (e) => {
            console.log(e.target.checked);
            if(e.target.checked){
                valor_pagado.removeAttribute('readonly');
                valor_pagado.removeAttribute('disabled');
            }else{
                valor_pagado.setAttribute('readonly', e.target.checked);
                valor_pagado.setAttribute('disabled', e.target.checked);
                valor_pagado.value = valor_inicial;
                alerta_diferencia_valor.style.display = "none";
            }
        
        })
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

        function checkDiffValue(e){
            if(valor_pagado.value != valor_inicial){
                alerta_diferencia_valor.style.display = "block";
            }else{
                alerta_diferencia_valor.style.display = "none";
            }
        }
    </script>
</x-app-layout> 