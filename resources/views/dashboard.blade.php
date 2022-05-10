<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tablero de usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bienvenido
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
                            <div class="text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-green-300 text-green-800 cursor-pointer">
                                <span class="fa-solid fa-handshake-simple block text-4xl" aria-hidden="true"></span>
                                <a href="#">Clientes</a>
                            </div>
                        </div>
                        <div class="access h-full w-full sm:w-1/2 md:w-1/4 lg:w-1/6 p-1">
                            <div class="text-center p-1 py-2 rounded shadow-md hover:shadow-lg hover:bg-cyan-300 text-cyan-800 cursor-pointer">
                                <span class="fa-solid fa-money-bill-transfer block text-4xl" aria-hidden="true"></span>
                                <a href="#">Prestamos</a>
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
