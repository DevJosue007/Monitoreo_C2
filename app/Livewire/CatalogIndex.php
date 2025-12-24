<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CatalogItem;

class CatalogIndex extends Component
{

    use WithPagination;

    // Propiedades del formulario
    public $definicion, $item_etiqueta, $item_valor, $estatus = 1;
    public $catalog_id;

    // Estados para modales
    public $isCreating = false;
    public $isEditing = false;
    public $search = '';


    // Reglas de registro y actualización
    protected function rules(){
        return [
            'definicion'    => 'required|string|max:50',
            'item_etiqueta' => 'required|string|max:100',
            'item_valor'    => 'required|string|max:20',
            'status'        => 'required|boolean'
        ];
    }

    // Mensajes de validación
    protected function messages(){
        return [
            'definicion.required'    => 'Favor de ingresar la definición a la cual pertenece el item.',
            'definicion.max'         => 'la definición no debe pasar de 50 caracteres.',
            'item_etiqueta.required' => 'Favor de ingresar una etiqueta al item.',
            'item_etiqueta.max'      => 'El valor de la etiqueta no debe superar los 100 caracteres.',
            'item_valor.required'    => 'Favor de agregar un valor al item.',
            'item_valor.max'         => 'El valor de la etiqueta no debe superar los 20 caracteres.',
            'status.requierd'        => 'Favor de seleccionar un estatus'
        ];
    }

    public function nuevoItem(){
        $this->isCreating = true;
        $this->isEditing = false;
    }

    public function cancel(){
        $this->reset();
        $this->isEditing = false;
        $this->isCreating = false;
        $this->resetValidation();
    }

    public function save(){
        $this->validate();

        $catalog = CatalogItem::create([
            'definicion'    => $this->definicion,
            'item_etiqueta' => $this->item_etiqueta,
            'item_valor'    => $this->item_valor,
            'status'        => $this->status,
        ]);
        $this->cancel();
        session()->flash('message', 'Item creado');

    }


    public function edit($id)
    {
        $item = CatalogItem::findOrFail($id);
        $this->catalog_id = $item->id;
        $this->definicion = $item->definicion;
        $this->item_etiqueta = $item->item_etiqueta;
        $this->item_valor = $item->item_valor;
        $this->estatus = $item->estatus;

        $this->isEditing = true;
        $this->isCreating = true;
    }

    public function update()
    {
        $this->validate();
        $item = CatalogItem::find($this->catalog_id);
        $item->update([
            'definicion' => $this->definicion,
            'item_etiqueta' => $this->item_etiqueta,
            'item_valor' => $this->item_valor,
            'estatus' => $this->estatus,
        ]);

        $this->cancel();
        session()->flash('message', 'Ítem actualizado.');
    }

    public function delete($id)
    {
        $item = CatalogItem::find($id);
        if($item){
            $item->delete();
            session()->flash('message', 'Item eliminado');
        }
    }


    public function render()
    {
        return view('livewire.catalog-index',[
            'items' => CatalogItem::where('item_etiqueta', 'like', '%'.$this->search.'%')
                            ->orWhere('definicion', 'like', '%'.$this->search.'%')            
                            ->orderBy('definicion')
                            ->paginate(10),
        ])->layout('layouts.app');
    }
}
