<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="px-6 py-3 mb-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <td scope="col" class="px-6 py-3">Nombre</td>
                        <td scope="col" class="px-6 py-3">Correo electrónico</td>
                        <td scope="col" class="px-6 py-3 w-12">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
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
        </div>
    </div>
    
    
    
</x-app-layout>