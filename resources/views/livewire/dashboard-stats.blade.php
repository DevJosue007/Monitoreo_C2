<div>{{-- DIV RAIZ --}}

    <x-section-title>
        <x-slot name="icon">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path
                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
            </svg>
        </x-slot>
        Estadisticas Generales
    </x-section-title>



    <div class="grid grid-cols-3 gap-2">
        {{-- contador de usuarios activos en tiempo real --}}
        <livewire:stats.active-users-count />
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-500">
            <div class="flex items-center">
                <div class="p-3 bg-cyan-100 rounded-full">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 uppercase"> Centros Penitenciarios <span
                            class="text-green-600 font-bold">Activos</span> </p>
                    <p class="text-3xl font-bold text-cyan-800">{{ $centrosPA }}</p>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-500">
            <div class="flex items-center">
                <div class="p-3 bg-cyan-100 rounded-full">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 uppercase">Reportes del día
                        <span class="font-bold text-cyan-500"> [ {{ $labelsKpis['rbd'] }} ] </span>
                    </p>
                    <p class="text-3xl font-bold text-cyan-800">{{ $reportsByDay }}</p>
                </div>
            </div>
        </div>

    </div>


    <div class="grid grid-cols-2 gap-2 mt-3">

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500 mb-5 content-center">

            <div class="ml-24">

                <div class="flex items-center space-x-2">
                    <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                        <x-heroicon-s-funnel class="w-5 h-5" />
                    </div>
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-tight">Filtrar Estadísticas</h3>
                </div>

                <div class="flex items-center gap-3">
                    <select wire:model.live="mes"
                        class="rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

                    <select wire:model.live="anio"
                        class="rounded-xl border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        @foreach ($years as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="ml-24">
                <div class="flex items-center py-4">
                    <div class="p-3 bg-indigo-100 rounded-full">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 uppercase">Reportes del Año
                            <span class="font-bold text-indigo-500"> [ {{ $labelsKpis['rby'] }} ] </span>
                        </p>
                        <p class="text-3xl font-bold text-indigo-800">{{ $reportsByYear }}</p>
                    </div>

                </div>
            </div>

            <div class="ml-24">
                <div class="flex items-center py-4">
                    <div class="p-3 bg-indigo-100 rounded-full">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path
                                d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 uppercase"> Reportes del mes
                            <span class="font-bold text-indigo-500"> [ {{ $labelsKpis['rbm'] }} ] </span>
                        </p>
                        <p class="text-3xl font-bold text-indigo-800">{{ $reportsByMonth }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-indigo-500 mb-5">
            <div livewire:updated>
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
        </div>

    </div>

    <div class="grid grid-cols-1 grid-rows-2 gap-2 mt-6">


        <div class="bg-white rounded-xl shadow-md p-6 border-grey-700">
            <h3 class="text-lg font-bold mb-4 text-gray-700 text-center"> Utlimos Reportes Generados</h3>
            <div class="space-y-4">
                @foreach ($lastReports as $report)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-800"> {{ Str::limit($report->descripcion, 40) }}
                            </p>
                            <p class="text-xs text-gray-500"> {{ $report->created_at->diffForHumans() }}</p>
                        </div>

                        @if ($report->tipo_inc_id == 'ti_01')
                            <span class="text-xs font-bold px-2 py-1 bg-green-200 rounded">Id #
                                {{ $report->id }}</span>
                        @endif
                        @if ($report->tipo_inc_id == 'ti_02')
                            <span class="text-xs font-bold px-2 py-1 bg-yellow-200 rounded">Id #
                                {{ $report->id }}</span>
                        @endif
                        @if ($report->tipo_inc_id == 'ti_03')
                            <span class="text-xs font-bold px-2 py-1 bg-red-200 rounded">Id #
                                {{ $report->id }}</span>
                        @endif

                    </div>
                @endforeach
            </div>

        </div>
    </div>

</div>
