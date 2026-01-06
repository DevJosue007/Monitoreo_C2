<div>{{-- DIV RAIZ --}}
   
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shado-md p-6 border-l-4 border-indigo-500">
        <div class="flex items-center">
            <div class="p-3 bg-indigo-100 rounded-full">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 uppercase">Total de Reportes</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalReports }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shado-md p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 uppercase">Registros Hoy</p>
                <p class="text-3xl font-bold text-gray-800"> {{ $reportsToday  }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
        <div class="flex items-center">
            <div class="p-3 bg-amber-100 rounded-full">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 uppercase">Areas por tipos de incidentes</p>
                <p class="text-3xl font-bold text-gray-800">{{ $reportsType->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Últimos Reportes</h3>
        <div class="space-y-4">
            @foreach ($lastReports as $report)
                <div class="flex items-center justify-between border-b pb-2">
                    <div>
                        <p class="text-sm font-semibold text-gray-800"> {{ Str::limit($report->descripcion, 40)}}</p>
                        <p class="text-xs text-gray-500"> {{ $report->created_at->diffForHumans()}}</p>
                    </div>
                    <span class="text-xs font-bold px-2 py-1 bg-gray-100 rounded"># {{$report->id }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<br>

<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="text-lg font-bold mb-4 text-gray-700">Distribución por Área</h3>
    <div class="space-y-4">
        @foreach ($reportsType as $item)
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-600">{{ $item->tipoinc }}</span>
                    <span class="text-sm font-bold text-gray-800">{{ $item->total }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    @php
                        $percentage = $totalReports > 0 ? ($item->total / $totalReports) * 100 : 0;
                    @endphp
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    
                </div>
            </div>
        @endforeach
    </div>
</div>




</div>
