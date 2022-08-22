<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan de pagos prestamo #'.$cuotas[0]->prestamo->id) }}
        </h2>
        <p class="text-secondary"><strong>Cliente:</strong> {{$cliente->nombres.' '.$cliente->lastname}}</p>
        <p class="text-secondary"><strong>Cobrador:</strong> {{$cobrador->user->name}}</p>
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Periodo</th>
                        <th scope="col" class="px-6 py-3">Fecha programada de pago</th>
                        <th scope="col" class="px-6 py-3">Fecha de pago</th>
                        <th scope="col" class="px-6 py-3">Valor de cuota</th>
                        <th scope="col" class="px-6 py-3">Valor pagado</th>
                        <th scope="col" class="px-6 py-3">Estado</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cuotas as $cuota)
                    <tr @if(date('Y-m-d', strtotime($cuota->fecha_pago_programado)) < date('Y-m-d')) 
                    class="red-alarm style-propagate-children" 
                    @elseif(date('Y-m-d', strtotime($cuota->fecha_pago_programado)) == date('Y-m-d'))
                    class="warning-alarm style-propagate-children" 
                    @endif>
                        <td class="px-6 py-3 bg-red-200">{{$cuota->id}}</td>
                        <td class="px-6 py-3">{{$cuota->periodo->descripcion}}</td>
                        <td class="px-6 py-3">{{date('d/m/Y', strtotime($cuota->fecha_pago_programado))}}</td>
                        <td class="px-6 py-3">
                        @if(!is_null($cuota->fecha_pago))
                            {{number_format($cuota->fecha_pago,0)}}
                        @else
                            @if(date('Y-m-d', strtotime($cuota->fecha_pago_programado)) < date('Y-m-d'))
                                <strong>ATRASADO</strong>
                            
                            @endif
                        @endif
                        </td>
                        <td class="px-6 py-3">{{number_format($cuota->valor_cuota,0)}}</td>
                        <td class="px-6 py-3">
                            {{number_format($cuota->valor_pagado,0)}}
                        
                        </td>
                        <td class="px-6 py-3">{{$cuota->estado->descripcion}}</td>
                        <td class="px-6 py-3 text-center">
                        @if($cuota->estado_prestamo_cuota_id != 2)
                            <a href="#" class="bg-white border border-green-600 text-green-600 p-1 rounded shadow-md" title="Registrar pago">
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
    </div>
</x-app-layout>
