<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="text-center md:text-left mb-4 py-3">
            <a href="#" class="w-full sm:w-auto inline-block border border-green-600 hover:border-green-700 bg-green-600 hover:bg-green-700 font-bold text-white shadow-sm hover:shadow-lg rounded-lg px-3 py-2 mr-3 uppercase">
                Registrar cliente
            </a>
        </div>
        
        @if(count($clientes) > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <td scope="col" class="px-6 py-3">Nombres</td>
                        <td scope="col" class="px-6 py-3">Identificación</td>
                        <td scope="col" class="px-6 py-3">Celular</td>
                        <td scope="col" class="px-6 py-3 w-12">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-3">{{ $user->nombres }} {{ $user->lastname }}</td>
                            <td class="px-6 py-3">{{ $user->identificacion }}</td>
                            <td class="px-6 py-3">{{ $user->cellphone }}</td>
                            <td class="px-6 py-3">
                                <button type="button" class="rounded-md shadow-sm hover:shadow-lg bg-yellow-400 px-2 py-1 text-xs" title="Editar registro">
                                    <span class="fa-solid fa-pen" aria-hidden="true"></span>
                                    <span class="sr-only">Editar registro</span>
                                </button>
                                <button type="button" class="rounded-md shadow-sm hover:shadow-lg bg-red-400 px-2 py-1 text-white text-xs" title="Eliminar registro">
                                    <span class="fa-solid fa-trash" aria-hidden="true"></span>
                                    <span class="sr-only">Eliminar registro</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $clientes->links() }}
        
        </div>
        @else
        <div class="px-4 py-3 rounded bg-sky-300 shadow-sm">
            No se han registrado clientes
        </div>
            
        @endif
    </div>
    
    
    
</x-app-layout>