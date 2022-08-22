<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prestamos realizados') }}
        </h2>
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full bg-white text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Cliente</th>
                        <th scope="col" class="px-6 py-3">Valor prestamo</th>
                        <th scope="col" class="px-6 py-3">Cuotas</th>
                        <th scope="col" class="px-6 py-3">Periodo</th>
                        <th scope="col" class="px-6 py-3">Fecha registro</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($prestamos as $prestamo)
                    <tr>
                        <td class="px-6 py-3">{{$prestamo->id}}</td>
                        <td class="px-6 py-3">{{$prestamo->cliente->nombres}} {{$prestamo->cliente->lastname}}</td>
                        <td class="px-6 py-3">{{number_format($prestamo->valor_prestamo, 0)}}</td>
                        <td class="px-6 py-3">{{$prestamo->cuotas}}</td>
                        <td class="px-6 py-3">{{$prestamo->periodo->descripcion}}</td>
                        <td class="px-6 py-3">{{date('d/m/Y', strtotime($prestamo->created_at))}}</td>
                        <td class="px-6 py-3">
                        
                            <a href="/plan-pagos?prestamo={{$prestamo->id}}" title="Ver plan de pagos">
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