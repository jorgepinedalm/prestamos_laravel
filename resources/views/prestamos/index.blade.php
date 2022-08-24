<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prestamos realizados') }}
        </h2>
        @if(!is_null($cobrador))
        <p><strong>Cobrador: </strong> {{$cobrador->user->name}}</p>
        @endif
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3" style="width: 90px;"># Factura</th>
                        <th scope="col" class="px-2 py-3">Cliente</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 110px;">Fecha registro</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 130px;">Vence</th>
                        <th scope="col" class="px-2 py-3"style="width: 80px;">Periodo</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 110px;">Valor prestado</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 80px;">Cuotas</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 110px;">Valor Cuota</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 110px;">Fecha últ. pago</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 110px;">Valor últ. pago</th>
                        <th scope="col" class="px-2 py-3 text-center" style="width: 80px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($prestamos as $prestamo)
                    <tr>
                        <td class="p-2">
                        <a class="text-sky-600 underline decoration-dashed hover:decoration-solid" href="/plan-pagos?prestamo={{$prestamo->id}}">{{str_pad($prestamo->id, 8, "0", STR_PAD_LEFT )}}</a>
                        </td>
                        <td class="px-2">{{$prestamo->cliente->nombres}} {{$prestamo->cliente->lastname}}</td>
                        
                        <td class="px-2 text-center">{{date('d/m/Y', strtotime($prestamo->created_at))}}</td>
                        <td class="px-2 text-center">
                            {{date('d/m/Y', strtotime($prestamo->prestamoCuotas->last()->fecha_pago_programado))}}
                        </td>
                        <td class="px-2">{{$prestamo->periodo->descripcion}}</td>
                        <td class="px-2 text-right">${{number_format($prestamo->valor_prestamo, 0)}}</td>
                        <td class="px-2 text-center">{{$prestamo->cuotas}}</td>
                        <td class="px-2 text-right">${{number_format($prestamo->prestamoCuotas->first()->valor_cuota, 0)}}</td>
                        <td class="px-2 text-center">
                        @if(!is_null($prestamo->prestamoCuotas->where('estado_prestamo_cuota_id', 2)->last()))
                            {{date('d/m/Y', strtotime($prestamo->prestamoCuotas->where('estado_prestamo_cuota_id', 2)->last()->fecha_pago_cuota))}}
                        @endif
                        
                        </td>
                        <td class="px-2 text-center">
                            @if(!is_null($prestamo->prestamoCuotas->where('estado_prestamo_cuota_id', 2)->last()))
                                ${{number_format($prestamo->prestamoCuotas->where('estado_prestamo_cuota_id', 2)->last()->valor_pagado, 0)}}
                            @endif
                        </td>
                        <td class="px-2 text-center">
                        
                            <a href="/plan-pagos?prestamo={{$prestamo->id}}" class="bg-white border border-green-600 text-green-600 px-2 py-1 rounded shadow-sm hover:shadow-lg" title="Ver plan de pagos">
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