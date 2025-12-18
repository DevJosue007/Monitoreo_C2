<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Report;
use App\Models\CatalogItem;
use Illuminate\Support\Facades\Auth;

class ReportIndex extends Component
{
    
    // --------------------------- Cargar información ------------------------
    public function render()
    {
        return view('livewire.report-index', [
            'reports' => Report::with('user')->orderBy('created_at', 'desc')->paginate(10),
            'centros' => CatalogItem::where('definicion', 'centros_penitenciarios')->where('estatus', true)->get(),
            'bloques' => CatalogItem::where('definicion' , 'bloques')->where('estatus', true)->get(),
            'areas'   => CatalogItem::where('definicion', 'areas')->where('estatus', true)->get(),
            'tipos'   => CatalogItem::where('definicion', 'tipos_inc')->where('estatus', true)->get(),
        ])->layout('layouts.app');
    }

    // Propiedades para el formulario de registro
    public $centroP_id, $bloque_id, $area_id, $tipoInc_id, $descripcion, $fecha_hora;
    public $isCreating = false; // Controla si se muestra el formulario

    // Propiedades para el formulario de editar
    public $report_id;
    public $isEditing = false;


    public function nuevoReporte(){
        $this->isCreating = true;
        $this->isEditing = false;
    }

    public function editarReporte(){
        $this->isCreating = false;
        $this->isEditing = true;
    }

    public function cancel(){
        $this->isEditing  = false;
        $this->isCreating = false;
        $this->reset(['centroP_id', 'bloque_id', 'area_id', 'tipoInc_id', 'descripcion', 'fecha_hora', 'isCreating']);
    }



    // 1. definir reglas
    protected function rules(){
        return[
            'centroP_id'  => 'required|exists:catalog_items, "item_valor"',
            'bloque_id'   => 'required|exists:catalog_items, "item_valor"',
            'area_id'     => 'required|exists:catalog_items, "item_valor"',
            'tipoInc_id'  => 'required|exists:catalog_items, "item_valor"',
            'descripcion' => 'required|min:1|max:500',
            'fecha_hora'  => 'required',
        ];
    }

    // 2. definir los mensajes personalizados
    protected function messages(){
        return [
            'centroP_id.required'  => 'Favor de indicar un Centro Penitenciario.',
            'bloque_id.required'   => 'Favor de indicar un bloque. ',
            'area_id.required'     => 'Favor de indicar un área. ',
            'tipoInc_id.required'  => 'Favor de indicar un tipo de incidente',
            'descripcion.required' => 'Favor de agregar una descripción',
            'descripcion.min'      => 'Sea mas específico (mínimo 1 caracteres).',
            'descripcion.max'      => 'Sea mas específico (máximo 500 caracteres).',
            'fecha_hora.required'  => 'Favor de indicar la fecha y hora del incidente.',
        ];
    }
    
    public function save(){
        // 3. Ejecutar la validación Livewire aplicará automáticamente rules() y messages()
        
        $this->validate();

        // Formatear la fecha que trae el HTML 
        $fechaFormat = date('Y-m-d H:i:s', strtotime($this->fecha_hora));
        Report::create([
            'user_id'        => Auth::id(),
            'centro_p_id'    => $this->centroP_id,
            'bloque_id'      => $this->bloque_id,
            'area_id'        => $this->area_id,
            'tipo_inc_id'    => $this->tipoInc_id,
            'descripcion'    => $this->descripcion,
            'fecha_hora_inc' => $fechaFormat,
        ]);
        session()->flash('message', 'Reporte creado exitosamente');
    }

    public function delete($id){
        $report = Report::find($id);
        if($report){
            $report->delete();
            session()->flash('message', 'Reporte eliminado correctamente');
        }
    }

    public function edit($id){

        $report = Report::findOrFail($id);

        $this->report_id   = $report->id;
        $this->centroP_id  = $report->centro_p_id;
        $this->bloque_id   = $report->bloque_id;
        $this->area_id     = $report->area_id;
        $this->tipoInc_id  = $report->tipo_inc_id;
        $this->descripcion = $report->descripcion;

        $this->fecha_hora = $report->fecha_hora_inc;
        //$this->fecha_hora = date('Y-m-d\TJ:i', strtotime($report->fecha_hora_inc));

        $this->isEditing  = true;
        $this->isCreating = true;

    }

    public function update(){
        $this->validate();

        $report = Report::find($this->report_id);

        $report->update([
            'centro_p_id'    => $this->centroP_id,
            'bloque_id'      => $this->bloque_id,
            'area_id'        => $this->area_id,
            'tipo_inc_id'    => $this->tipoInc_id,
            'descripcion'    => $this->descripcion,
            'fecha_hora_inc' => $this->fecha_hora,            
        ]);

        $this->cancel();
        session()->flash('message', 'Reporte actualizado correctamente.');

    }

    




}
