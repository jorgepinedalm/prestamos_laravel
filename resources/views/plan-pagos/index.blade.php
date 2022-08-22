<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan de pagos de '.$cliente->nombres.' '.$cliente->lastname) }}
        </h2>
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
                    <tr>
                        <td class="px-6 py-3">{{$cuota->id}}</td>
                        <td class="px-6 py-3">{{$cuota->periodo->descripcion}}</td>
                        <td class="px-6 py-3">{{date('d/m/Y', strtotime($cuota->fecha_pago_programado))}}</td>
                        <td class="px-6 py-3">{{$cuota->fecha_pago}}</td>
                        <td class="px-6 py-3">{{number_format($cuota->valor_cuota,0)}}</td>
                        <td class="px-6 py-3">{{number_format($cuota->valor_pagado,0)}}</td>
                        <td class="px-6 py-3">{{$cuota->estado->descripcion}}</td>
                        <td class="px-6 py-3">
                        
                            <a href="#" title="Ver plan de pagos">
                                <span class="fa-solid fa-eye" aria-hidden="true"></span>
                                <span class="sr-only">Ver plan de pagos</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
