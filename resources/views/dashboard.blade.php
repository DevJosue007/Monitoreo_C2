<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
            
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg shadow">
                        <h4 class="font-bold text-blue-800">Reportes</h4>
                        <p class="text-sm text-gray-600"> Gestión de reportes e incidentes.</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('reportes.index') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Reportes</a>
                        </div>

                    </div>

                    <br>
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg shadow">
                        <h4 class="font-bold text-blue-800">Catalogos</h4>
                        <p class="text-sm text-gray-600"> Gestion de catalogos </p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('catalogos.index') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Reportes</a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
