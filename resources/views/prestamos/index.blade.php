<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prestamos realizados') }}
        </h2>
    </x-slot>
    {{$prestamos}}
    
</x-app-layout>