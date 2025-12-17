<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Report;
use App\Models\CatalogItem;
use Illuminate\Support\Facades\Auth;

class ReportIndex extends Component
{

    // Propiedades para el formulario:
    public $centroP_id, $bloque_id, $area_id, $tipoInc_id, $descripcion, $fecha_hora;
    public $isCreating = false; // Controla si se muestra el formulario

    // Cargar Catálogos
    public function render()
    {
        return view('livewire.report-index', [
            'reports' => Report::with('user')->orderBy('created_at', 'desc')->paginate(10),
            'centros' => CatalogItem::where('definicion', 'centro_monitoreo')->where('estatus', true)->get(),
            'bloques' => CatalogItem::where('definicion' , 'bloques')->where('estatus', true)->get(),
            'areas'   => CatalogItem::where('definicion', 'area')->where('estatus', true)->get(),
            'tipos'   => CatalogItem::where('definicion', 'tipo_incidente')->where('estatus', true)->get(),
        ]);
    }


    public function save(){

        $this->validate([
            'centroP_id'  => 'required',
            'bloque_id'   => 'required',
            'area_id'     => 'required',
            'tipoInc_id'  => 'required',
            'descripcion' => 'required|min:10',
            'fecha_hora'  => 'required',
        ]);

        Report::create([
            'user_id'    => Auth::id(),
            'centroP_id' => $this->centroP_id,
            'bloque_id'  => $this->bloque_id,
            'area_id'    => $this->area_id,
            'tipoInc_id' => $this->tipoInc_id,
            'descripcion'=> $this->descripcion,
            'fecha_hora' => $this->fecha_hora,
        ]);

        $this->reset(['centroP_id', 'bloque_id', 'area_id', 'tipoInc_id', 'descripcion', 'fecha_hora', 'isCreating']);
        session()->flash('message', 'Reporte creado exitosamente');


    }


}
