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
                        <h4 class="font-bold text-blue-800">Operaciones </h4>
                        <p class="text-sm text-gray-600"> Gestión de reportes e incidentes.</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('reportes.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Nuevo Reporte</a>
                            <a href="{{ route('reportes.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm hover:gb-gray-300"> Historial</a>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
