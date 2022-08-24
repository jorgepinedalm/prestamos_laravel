<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Plan de pagos crédito #'.$cuotas[0]->prestamo->id) }}
        </h2>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                <p class="text-secondary"><strong>Cliente:</strong> {{$cliente->nombres.' '.$cliente->lastname}}</p>
                <p class="text-secondary"><strong>Cobrador:</strong> {{$cobrador->user->name}}</p>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex flex-wrap">
                    <div class="w-full sm:w-1/2">
                        <p class="text-secondary"><strong>Fecha inicio:</strong> {{date('d/m/Y',strtotime($cuotas[0]->prestamo->fecha_inicio_prestamo))}}</p>
                        <p class="text-secondary"><strong>No. de cuotas:</strong> 
                        {{$cuotas->total()}} 
                        <span class="fas fa-info-circle" title="Detalle de cuotas" 
                        data-toggle="popover" 
                        data-placement="bottom"
                        data-content="<p>Cuotas totales: {{$cuotas->total()}}</p><p>Cuotas pagadas: {{$cuotas_pagadas}}</p><p>Cuotas atrasadas: {{$cuotas_atrasadas}}</p>"></span>
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <p class="text-secondary"><strong>Saldo:</strong> ${{number_format($saldo,0)}}</p>
                    </div>
                </div>
                
            </div>
        </div>
        
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="flex flex-wrap lg:flex-nowrap w-full">
            <div class="grow w-full lg:w-max">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-2 py-3" style="width: 60px;">ID</th>
                                <th scope="col" class="px-2 py-3">Periodo</th>
                                <th scope="col" class="px-2 py-3" style="width: 130px;">Fecha de pago</th>
                                <th scope="col" class="px-2 py-3" style="width: 130px;">Fecha abono</th>
                                <th scope="col" class="px-3 py-3">Valor de cuota</th>
                                <th scope="col" class="px-6 py-3">Valor pagado</th>
                                <th scope="col" class="px-2 py-3">Estado</th>
                                <th scope="col" class="px-2 py-3" style="width: 90px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cuotas as $cuota)
                            <tr @if($cuota->estado_prestamo_cuota_id == 1 && date('Y-m-d', strtotime($cuota->fecha_pago_programado)) < date('Y-m-d')) 
                            class="red-alarm style-propagate-children" 
                            @elseif($cuota->estado_prestamo_cuota_id == 1 && date('Y-m-d', strtotime($cuota->fecha_pago_programado)) == date('Y-m-d'))
                            class="warning-alarm style-propagate-children" 
                            @elseif($cuota->estado_prestamo_cuota_id == 2)
                            class="bg-green-100 style-propagate-children" 
                            @endif>
                                <td class="px-2 py-3">{{$cuota->id}}</td>
                                <td class="px-2 py-3">{{$cuota->periodo->descripcion}}</td>
                                <td class="px-2 py-3">{{date('d/m/Y', strtotime($cuota->fecha_pago_programado))}}</td>
                                <td class="px-2 py-3">
                                @if(!is_null($cuota->fecha_pago_cuota))
                                    {{date('d/m/Y', strtotime($cuota->fecha_pago_cuota,0))}}
                                @else
                                    @if(date('Y-m-d', strtotime($cuota->fecha_pago_programado)) < date('Y-m-d'))
                                        <strong>ATRASADO</strong>
                                    
                                    @endif
                                @endif
                                </td>
                                <td class="px-2 py-3">${{number_format($cuota->valor_cuota,0)}}</td>
                                <td class="px-2 py-3">
                                    ${{number_format($cuota->valor_pagado,0)}}
                                
                                </td>
                                <td class="px-2 py-3">{{$cuota->estado->descripcion}}</td>
                                <td class="px-2 py-3 text-center">
                                @if($cuota->estado_prestamo_cuota_id != 2)
                                    <a href="/registrar-pago?cuota={{$cuota->id}}" class="bg-white border border-green-600 text-green-600 p-1 rounded shadow-md" title="Registrar pago">
                                        <span class="fas fa-hand-holding-usd" aria-hidden="true"></span>
                                        <span class="sr-only">Registrar pago</span>
                                    </a>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-3">{{ $cuotas->appends(['prestamo' => $cuotas[0]->prestamo->id])->links() }}</div>
            </div>
            <div class="w-full pl-0 lg:pl-3 lg:w-52 xl:w-60 2xl:w-80">
                <div class="bg-white p-3 h-full text-small rounded shadow-md">
                    <p>Panel para generar reportes</p>
                    <button type="button" class="w-full bg-white text-grey-500 p-2 rounded border border-grey-500 shadow-md hover:shadow-lg">Ver extracto</button>
                </div>
                
            </div>
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
