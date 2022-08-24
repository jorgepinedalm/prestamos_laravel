<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Tarjetas del día '.date('d/m/Y')) }}
        </h2>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                <p class="text-secondary"><strong>Cobrador:</strong> {{$cobrador->user->name}}</p>
            </div>
            
        </div>
        
    </x-slot>
    
    <div class="tarjeta-wrapper flex flex-wrap justify-center items-center bg-stone-50 p-3 sm:px-8">
        <div class="tarjeta w-full md:w-4/5 lg:w-2/3 2xl:w-1/2 bg-white border border-cyan-600 shadow-lg rounded mb-3">
            <h3 class="text-center bg-cyan-600 text-white p-2 font-bold">Tarjeta # {{str_pad($cuotas[0]->prestamo->id, 7, "0", STR_PAD_LEFT )}}</h3>
            @if(isset($cliente))
            <div class="flex flex-wrap w-full px-2 py-3 sm:px-3 text-xs sm:text-sm 2xl:text-base">
                
                <div class="field pb-3 px-2 w-full md:w-2/3 flex items-center">
                    <label class="inline-block font-bold mr-2">Nombres: </label>
                    <span class="text-plain w-full">{{$cliente->nombres.' '.$cliente->lastname}}</span>
                </div>
                <div class="field pb-3 px-2 w-full md:w-1/3 flex items-center">
                    <label class="inline-block font-bold mr-2">Identificación: </label>
                    <span class="text-plain w-full">{{$cliente->identificacion}}</span>
                </div>
                <div class="field pb-3 px-2 w-full flex items-center">
                    <label class="inline-block font-bold mr-2">Dirección: </label>
                    <span class="text-plain w-full">{{$cliente->address}}</span>
                </div>
                <div class="field pb-3 px-2 w-1/2 sm:w-1/3 md:w-1/5">
                    <label class="block font-bold">Fecha venta: </label>
                    <span class="text-plain w-full">{{date('d/m/Y',strtotime($cuotas[0]->prestamo->fecha_inicio_prestamo))}}</span>
                </div>
                <div class="field pb-3 px-2 w-1/2 sm:w-1/3 md:w-1/5">
                    <label class="block font-bold">Valor: </label>
                    <span class="text-plain w-full">${{number_format($cuotas[0]->prestamo->valor_prestamo,0)}}</span>
                </div>
                <div class="field pb-3 px-2 w-1/3 sm:w-1/3 md:w-1/5">
                    <label class="block font-bold"># cuotas:</label>
                    <span class="text-plain w-full">
                        {{$cuotas[0]->prestamo->cuotas}} 
                        <span class="fas fa-info-circle" title="Detalle de cuotas" 
                            data-toggle="popover" 
                            data-placement="bottom"
                            data-content="<p>Cuotas totales: {{count($cuotas)}}</p><p>Cuotas pagadas: {{$cuotas_pagadas}}</p><p>Cuotas atrasadas: {{$cuotas_atrasadas}}</p>">
                        </span>
                    </span>
                </div>
                <div class="field pb-3 px-2 w-1/3 md:w-1/5">
                    <label class="block font-bold">Valor cuota: </label>
                    <span class="text-plain w-full">${{number_format($cuotas[0]->valor_cuota,0)}}</span>
                </div>
                <div class="field pb-3 px-2 w-1/3 md:w-1/5">
                    <label class="block font-bold">Saldo: </label>
                    <span class="text-plain w-full">${{number_format($saldo,0)}}</span>
                </div>
            </div>
            @endif
            <div class="flex flex-wrap w-full">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    @if($cuotas[0]->prestamo->periodo_prestamo_id == 1)
                    <span class="italic font-bold text-secondary text-sm mb-2 px-2 inline-block text-slate-400">Esta tarjeta se cobra todos los días</span>
                    @elseif($cuotas[0]->prestamo->periodo_prestamo_id == 2)
                    <span class="italic font-bold text-secondary text-sm mb-2 px-2 inline-block text-slate-400">
                    Esta tarjeta se cobra semanalmente todos los
                    @switch(date('w', strtotime($cuotas[0]->fecha_pago_programado)))
                        @case(1)
                            Lunes
                            @break
                        @case(2)
                            Martes
                            @break
                        @case(3)
                            Miércoles
                            @break
                        @case(4)
                            Jueves
                            @break
                        @case(5)
                            Viernes
                            @break
                        @case(6)
                            Sabado
                            @break
                        @case(7)
                            Domingo
                            @break
                        @default
                            Días
                    @endswitch
                    </span>
                    @endif
                </div>
                <div class="w-full md:w-1/2 text-center md:text-right">
                    <span class="mr-3 text-sm italic text-slate-500">
                        <span class="rounded-full p-1 bg-green-100 inline-block border-2"></span> Pagado
                    </span>
                    <span class="mr-3 text-sm italic text-slate-500">
                        <span class="rounded-full p-1 bg-amber-100 inline-block border-2"></span> Pago hoy
                    </span>
                    <span class="mr-3 text-sm italic text-slate-500">
                        <span class="rounded-full p-1 bg-red-100 inline-block border-2"></span> Atrasado
                    </span>
                </div>
            </div>
            
            
            <div class="flex flex-wrap">
            @for($filas = 0; $filas < count($cuotas); $filas++)
                <div class="w-1/3 sm:w-1/4 md:w-1/6 border border-primary inline-block p-2 pt-4 relative
                @if($cuotas[$filas]->estado_prestamo_cuota_id == 1 && date('Y-m-d', strtotime($cuotas[$filas]->fecha_pago_programado)) < date('Y-m-d')) 
                 bg-red-100            
                @elseif($cuotas[$filas]->estado_prestamo_cuota_id == 1 && date('Y-m-d', strtotime($cuotas[$filas]->fecha_pago_programado)) == date('Y-m-d'))
                bg-amber-100
                @elseif($cuotas[$filas]->estado_prestamo_cuota_id == 2)
                bg-green-100 
                @endif
                ">
                    <span class="text-xs text-slate-400 absolute top-0 left-0">
                    {{$filas+1}} - {{date('d/m/Y',strtotime($cuotas[$filas]->fecha_pago_programado))}}
                    </span> 
                    @if($cuotas[$filas]->estado_prestamo_cuota_id == 2)
                        <span class="p-1 text-center inline-block text-sm w-full text-secondary">${{number_format($cuotas[$filas]->valor_pagado,0)}}</span>
                    @elseif($cuotas[$filas]->estado_prestamo_cuota_id == 1)
                        <button type="button" onclick="window.location.href='/registrar-pago?cuota={{$cuotas[$filas]->id}}'" class="rounded 
                        @if(date('Y-m-d', strtotime($cuotas[$filas]->fecha_pago_programado)) < date('Y-m-d') || date('Y-m-d', strtotime($cuotas[$filas]->fecha_pago_programado)) == date('Y-m-d'))
                        bg-green-600 border-green-600 text-white font-bold shadow-sm hover:shadow-lg
                        @else
                        border-green-400 
                        @endif
                        border 
                        p-1 text-sm w-full">${{number_format($cuotas[$filas]->valor_cuota,0)}}</button>
                    @endif
                    
                    
                </div>
            @endfor
            </div>
        </div>
        <div class="p-3 mb-3 w-full text-center">
            @if(!is_null($anterior))
            <a href="/plan-pagos/tarjeta?prestamo={{$anterior->prestamo_id}}" class="rounded px-3 py-2 bg-white border font-bold shadow-sm hover:shadow-lg mr-2">Anterior</a>
            @endif
            @if(!is_null($siguiente))
            <a href="/plan-pagos/tarjeta?prestamo={{$siguiente->prestamo_id}}" class="rounded px-3 py-2 bg-white border font-bold shadow-sm hover:shadow-lg">Siguiente</a>
            @endif
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover({
                html: true
            });
        })
    </script>
</x-app-layout>