<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;
use Carbon\Carbon;

class DashboardStats extends Component
{

    public function render()
    {
        
        $fechaActual = Carbon::now();
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',       4 => 'Abril',    5 => 'Mayo',      6 => 'Junio',
            7 => 'Julio', 8 => 'Agosto',  9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre',12 => 'Diciembre'
        ];
        $diasSemana = [
            0 => 'Domingo', 1 => 'Lunes',   2 => 'Martes', 3 => 'Miércoles', 
            4 => 'Jueves',  5 => 'Viernes', 6 => 'Sábado'
        ];


        // Reportes por Año 
        $reportsByYear = Report::whereYear('created_at', Carbon::now()->year)
            ->count();

        // Reportes por mes
        $reportsByMonth = Report::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Reportes por día
        $reportsByDay = Report::whereDate('created_at', Carbon::today())->count();

        // Reportes por tipo de indicdente
        $reportsTypeStats = Report::join('catalog_items', 'reports.tipo_inc_id', '=', 'catalog_items.item_valor')
            ->where('catalog_items.definicion', '=', 'tipos_inc')
            ->selectRaw("
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Bajo' THEN 1 ELSE 0 END) as bajo,
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Medio' THEN 1 ELSE 0 END) as medio,
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Alto' THEN 1 ELSE 0 END) as alto
            ")
            ->first();

        return view('livewire.dashboard-stats', [
            'reportsByYear'  => $reportsByYear,
            'reportsByMonth' => $reportsByMonth,
            'reportsByDay'   => $reportsByDay,
            'reportsType'    => [
                'bajo'  => $reportsTypeStats->bajo  ?? 0,
                'medio' => $reportsTypeStats->medio ?? 0,
                'alto'  => $reportsTypeStats->alto  ?? 0,
            ],
            // Etiquetas de Kpis (Key Performace Indicators) 
            'labelsKpis'     => [
                'rby'   => Carbon::now()->year,
                'rbm'   => $meses[$fechaActual->month],
                'rbd'   => $diasSemana[$fechaActual->dayOfWeek],
            ],
            'lastReports'  => Report::latest()->take(10)->get()
        ])->layout('layouts.app');
    }
}
