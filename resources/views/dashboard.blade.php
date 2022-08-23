<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tablero de usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center md:text-right mb-4 p-3">
                <a href="#" class="w-full sm:w-auto inline-block mb-3 sm:mb-0 border border-green-600 hover:border-green-700 bg-green-600 hover:bg-green-700 font-bold text-white shadow-sm hover:shadow-lg rounded-lg px-3 py-2 mr-3 uppercase">
                    Registrar pago
                </a>
                <a href="/prestamos/create" class="w-full sm:w-auto inline-block mb-3 sm:mb-0 border border-green-600 hover:border-green-700 font-bold text-green-600 hover:text-green-700 shadow-sm hover:shadow-lg rounded-lg px-3 py-2 uppercase">
                    Hacer prestamo
                </a>
            </div>
            <div class="pb-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200 p-6">
                    <h3 class="text-gray-800 font-bold">Cobros del día de hoy ({{date('d/m/Y')}})</h3>
                    @if(count($pagos) > 0)
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 py-3" style="width: 90px;"># Factura</th>
                                        <th scope="col" class="px-2 py-3">Cliente</th>
                                        <th scope="col" class="px-2 py-3">Periodo</th>
                                        <th scope="col" class="px-2 py-3 text-center" style="width: 130px;">Valor de cuota</th>
                                        <th scope="col" class="px-2 py-3 text-center" style="width: 130px;">Valor pagado</th>
                                        <th scope="col" class="px-2 py-3 text-center" style="width: 130px;">Saldo</th>
                                        <th scope="col" class="px-2 py-3" style="width: 100px;">Estado</th>
                                        <th scope="col" class="px-2 py-3" style="width: 80px;min-width:80px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pagos as $pago)
                                        <tr>
                                            <td class="p-2"><a href="/plan-pagos?prestamo={{$pago->prestamo->id}}">{{str_pad($pago->prestamo->id, 8, "0", STR_PAD_LEFT )}}</a></td>
                                            <td class="p-2">{{$pago->cliente->nombres}} {{$pago->cliente->lastname}}</td>
                                            <td class="p-2">{{$pago->periodo->descripcion}}</td>
                                            <td class="p-2 text-right">${{number_format($pago->valor_cuota,0)}}</td>
                                            <td class="p-2 text-right">${{number_format($pago->valor_pagado,0)}}</td>
                                            <td class="p-2 text-right">${{number_format($pago->saldo,0)}}</td>
                                            <td class="p-2">{{$pago->estado->descripcion}}</td>
                                            <td class="p-2 text-center">
                                                <a href="#" class="bg-white border border-slate-600 text-slate-600 mr-2 p-1 rounded shadow-md" title="Ver más información">
                                                    <span class="fas fa-search" aria-hidden="true"></span>
                                                    <span class="sr-only">Ver más información</span>
                                                </a>
                                                @if($pago->estado_prestamo_cuota_id != 2)
                                                    <a href="/registrar-pago?cuota={{$pago->id}}" class="bg-white border border-green-600 text-green-600 p-1 rounded shadow-md" title="Registrar pago">
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
                    @else
                        <p>No hay cobros a realizar el día de hoy</p>
                    @endif
                    
                </div>
                
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Bienvenido, admin</p>
                    <div class="access-cards flex flex-wrap">
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="relative text-center p-1 py-2 rounded shadow-md border-l-4 border-red-300 hover:shadow-lg hover:bg-red-300 text-red-800 cursor-pointer">
                                <span class="fa-solid fa-users block text-4xl" aria-hidden="true"></span>
                                <a href="/usuarios" class="stretched-link">Usuarios</a>
                            </div>
                        </div>
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-sky-300 text-sky-800 cursor-pointer">
                                <span class="fa-solid fa-hand-holding-dollar block text-4xl" aria-hidden="true"></span>
                                <a href="#">Cobradores</a>
                            </div>
                        </div>
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="relative text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-green-300 text-green-800 cursor-pointer">
                                <span class="fa-solid fa-handshake-simple block text-4xl" aria-hidden="true"></span>
                                <a href="/clientes" class="stretched-link">Clientes</a>
                            </div>
                        </div>
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="relative text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-cyan-300 text-cyan-800 cursor-pointer">
                                <span class="fa-solid fa-money-bill-transfer block text-4xl" aria-hidden="true"></span>
                                <a href="/prestamos" class="stretched-link">Prestamos</a>
                            </div>
                        </div>
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-orange-300 text-orange-800 cursor-pointer">
                                <span class="fa-solid fa-file block text-4xl" aria-hidden="true"></span>
                                <span class="fa-solid fa-files block text-4xl" aria-hidden="true"></span>
                                <a href="#">Reportes</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
