<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;
use Carbon\Carbon;

class DashboardStats extends Component
{
    public function render()
    {

        // Reportes Totales 
        $totalReports = Report::count();
        // Reportes del día
        $reportsToday = Report::whereDate('created_at', Carbon::today())->count();
        // Reportes por tipo de indicdente
        $reportsType = Report::join('catalog_items', 'reports.tipo_inc_id', '=', 'catalog_items.item_valor')
            ->selectRaw('catalog_items.item_etiqueta as tipoinc, count(*) as total')
            ->groupBy('tipoinc')
            ->get();

            

        return view('livewire.dashboard-stats',[
            'totalReports' => $totalReports,
            'reportsToday' => $reportsToday,
            'reportsType'  => $reportsType,
            'lastReports'  => Report::latest()->take(5)->get()
        ])->layout('layouts.app');
    }


}
