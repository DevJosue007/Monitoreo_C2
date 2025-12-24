<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Report;
use App\Models\CatalogItem;
use App\Models\MediaFile;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ReportIndex extends Component
{
    // Propiedades Carga de archivos
    use WithFileUploads;
    public $archivos = [];

    // Propiedades para registro
    public $centroP_id, $bloque_id, $area_id, $tipoInc_id, $descripcion, $fecha_hora;
    public $isCreating = false; // Controla si se muestra el formulario

    // Propiedades para actualización
    public $report_id;
    public $isEditing = false;

    // Propiedades para galeria de archivos cargados
    public $showGallery = false;
    public $galleryMedia = [];
    public $reportTitle = '';
    
    
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

    public function nuevoReporte(){
        $this->isCreating = true;
        $this->isEditing = false;
    }

    public function cancel(){
        $this->reset();
        $this->isEditing  = false;
        $this->isCreating = false;
        $this->resetValidation();
    }

    // Reglas para guardar y editar
    protected function rules(){
        return[
            'centroP_id'  => 'required|exists:catalog_items, "item_valor"',
            'bloque_id'   => 'required|exists:catalog_items, "item_valor"',
            'area_id'     => 'required|exists:catalog_items, "item_valor"',
            'tipoInc_id'  => 'required|exists:catalog_items, "item_valor"',
            'descripcion' => 'required|min:1|max:500',
            'fecha_hora'  => 'required',
            'archivos.*'  => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', //Max: 20 MB
        ];
    }

    // Mensajes personalizados
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
    
    // Metodo para guardar
    public function save(){
        //Ejecutar la validación Livewire aplicará automáticamente rules() y messages()
        $this->validate();

        // Guardar campos formulario
        // Formatear la fecha que trae el HTML 
        $fechaFormat = date('Y-m-d H:i:s', strtotime($this->fecha_hora));
        $report = Report::create([
            'user_id'        => Auth::id(),
            'centro_p_id'    => $this->centroP_id,
            'bloque_id'      => $this->bloque_id,
            'area_id'        => $this->area_id,
            'tipo_inc_id'    => $this->tipoInc_id,
            'descripcion'    => $this->descripcion,
            'fecha_hora_inc' => $fechaFormat,
        ]);
        // Procesamiento de archivos
        foreach($this->archivos as $archivo){
            // Guarda en la carpeta 'reportes' dentro de public
            $path = $archivo->store('reportes', 'public');
            // registra en la tabla media_files
            MediaFile::create([
                'media_fileable_id'   => $report->id,            // El ID del reporte creado
                'media_fileable_type' => Report::class,          // Esto guardará "App\Models\Report"
                'archivo_ruta'   => $path,
                'archivo_nombre' => $archivo->getClientOriginalName(),
                'archivo_tipo'   => $archivo->getMimeType(),
                'archivo_tamanio'=> $archivo->getSize(),
            ]);
        }

        $this->cancel();
        session()->flash('message', 'Reporte creado exitosamente');
    }

    // Metodo para eliminar
    public function delete($id){
        $report = Report::find($id);
        if($report){
            $report->delete();
            session()->flash('message', 'Reporte eliminado correctamente');
        }
    }

    // metodo para cargar la información a editar
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

    // Metodo para guardar la actualización
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


    //Metodo modal 
    public function openGallery($reportId){

        $report = Report::with('media')->findOrFail($reportId);

        
        //Cargamos los archivos y el titulo para el modal
        $this->galleryMedia = $report->media;
        $this->reportTitle  = "Evidencia del reporte #".$report->id;
        $this->showGallery  = true;
    }
    public function closeGallery(){
        $this->showGallery = false;
        $this->reset(['galleryMedia', 'reportTitle']);
    }



}
