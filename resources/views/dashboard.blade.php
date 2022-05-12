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
                    <h3 class="text-gray-800 font-bold">Cobros del día de hoy</h3>
                    <p>No hay cobros a realizar el día de hoy</p>
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
