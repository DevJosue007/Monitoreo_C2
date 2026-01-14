<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;
use App\Models\CatalogItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardStats extends Component
{

    public $mes;
    public $anio;


    public function mount(){
        // inicializar variables
        $this->mes = Carbon::now()->month;
        $this->anio = Carbon::now()->year;
    }

    public function render()
    {
        // Filtrado de reportes
        

        // Datos para obtener el numero de reportes
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
        $reportsByYear = Report::whereYear('created_at', $this->anio)
            ->count();

        // Reportes por mes
        $reportsByMonth = Report::whereMonth('created_at', $this->mes)
            ->whereYear('created_at', $this->anio)
            ->count();

        // Reportes en el día
        $reportsByDay = Report::whereDate('created_at', Carbon::today())->count();

        // Reportes por tipo de indicdente
        $reportsTypeStats = Report::join('catalog_items', 'reports.tipo_inc_id', '=', 'catalog_items.item_valor')
            ->where('catalog_items.definicion', '=', 'tipos_inc')
            ->whereYear('reports.created_at', $this->anio)
            ->whereMonth('reports.created_at', $this->mes)
            ->selectRaw("
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Bajo' THEN 1 ELSE 0 END) as bajo,
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Medio' THEN 1 ELSE 0 END) as medio,
                SUM(CASE WHEN catalog_items.item_etiqueta = 'Alto' THEN 1 ELSE 0 END) as alto
            ")
            ->first();
        
        // Centros penitenciarios activos
        $centrosP = CatalogItem::where([
            ['definicion', '=', 'centros_penitenciarios'],
            ['estatus', '=', '1']
        ])
        ->count();


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
            'lastReports'  => Report::latest()->take(10)->get(),
            'centrosPA'    => $centrosP,
            'years' => range(Carbon::now()->year, 2023), // Rango de años para el select
        ])->layout('layouts.app');
    }
}
