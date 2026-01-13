<div>{{-- DIV RAIZ --}}

    <div class="grid grid-cols-3 gap-2 mt-6">

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-100 rounded-full">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 uppercase">Reportes del Año 
                        <span class="font-bold text-indigo-500">  [ {{ $labelsKpis['rby']}} ] </span>
                    </p>
                    <p class="text-3xl font-bold text-gray-800">{{ $reportsByYear }}</p>
                </div>

            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 uppercase"> Reportes del mes
                        <span class="font-bold text-green-500"> [ {{ $labelsKpis['rbm']}} ] </span>
                    </p>
                    <p class="text-3xl font-bold text-gray-800">{{ $reportsByMonth }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-pink-500">
            <div class="flex flex-center">
                <div class="p-3 bg-pink-100 rounded-full">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 uppercase">Reportes del día
                        <span class="font-bold text-pink-500">  [ {{ $labelsKpis['rbd']}} ] </span>
                    </p>
                    <p class="text-3xl font-bold text-gray-800">{{ $reportsByDay }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 grid-rows-2 gap-2 mt-8">

        <div class="bg-white rounded-xl shadow-md p-6 border-grey-700">
            <h3 class="text-lg font-bold mb-4 text-gray-700 text-center"> Nivel de incidentes</h3>
            <div style="max-height: 300px;">
                <canvas id="incidentChar"></canvas>
                @script
                    <script>
                        const ctx = document.getElementById('incidentChar');
                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Bajo', 'Medio', 'Alto'],
                                datasets: [{
                                    data: [
                                        @js($reportsType['bajo']),
                                        @js($reportsType['medio']),
                                        @js($reportsType['alto']),
                                    ],
                                    backgroundColor: [
                                        '#05DF72',
                                        '#FFD230',
                                        '#FB2C36'
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugin: {
                                    legends: {
                                        display: false
                                    }
                                }
                            }
                        });
                    </script>
                @endscript

            </div>
            <div class="mt-6 grid grid-cols-3 gap-1 text-center text-xs">
                <div>
                    <span class="block w-3 h-3 mx-auto rounded-full bg-green-500"></span>
                    <span class="text-gray-600">Bajo ({{ $reportsType['bajo'] }}) </span>
                </div>
                <div>
                    <span class="block w-3 h-3 mx-auto rounded-full bg-yellow-400"></span>
                    <span class="text-gray-600">Medio ({{ $reportsType['medio'] }})</span>
                </div>
                <div>
                    <span class="block w-3 h-3 mx-auto rounded-full bg-red-600"></span>
                    <span class="text-gray-600">Alto ({{ $reportsType['alto'] }})</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-grey-700">
            <h3 class="text-lg font-bold mb-4 text-gray-700 text-center"> Últimos Reportes</h3>
            <div class="space-y-4">
                @foreach ($lastReports as $report)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800"> {{ Str::limit($report->descripcion, 40) }}</p>
                            <p class="text-xs text-gray-500"> {{ $report->created_at->diffForHumans() }}</p>
                        </div>

                        
                        @if ($report->tipo_inc_id == 'ti_01')
                            <span class="text-xs font-bold px-2 py-1 bg-green-200 rounded">Id # {{ $report->id }}</span>        
                        @endif
                        @if ($report->tipo_inc_id == 'ti_02')
                            <span class="text-xs font-bold px-2 py-1 bg-yellow-200 rounded">Id # {{ $report->id }}</span>        
                        @endif
                        @if ($report->tipo_inc_id == 'ti_03')
                            <span class="text-xs font-bold px-2 py-1 bg-red-200 rounded">Id # {{ $report->id }}</span>        
                        @endif

                    </div>
                @endforeach
            </div>

        </div>
    </div>

</div>
