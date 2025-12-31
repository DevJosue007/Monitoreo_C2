<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleIndex extends Component
{

    use WithPagination;

    public $name, $role_id;
    public $isCreating = false;
    public $isEditing = false;
    public $search="";

    public function render()
    {
        return view('livewire.role-index',[
            'roles' => Role::where('name', 'like', '%'.$this->search.'%')->paginate(10)
        ])->layout('layouts.app');
    }
    
    public function nuevoRol(){
        $this->isCreating = true;
        $this->isEditing = false;
    }


    protected function rules(){
        return [
            'name' =>'required|unique:roles,name|alpha_dash|max:255|min:5'
        ];
    }

    protected function messages(){
        return[
            'name.required'     => 'Favor de ingresar un nombre al nuevo rol.',
            'name.unique'       => 'Rol duplicado, favor de cambiarlo.',
            'name.alpha_dash'   => 'No se permiten caracteres especiales.',
            'name.max'          => 'El nombre del rol no puede superar los 255 cáracteres.',
            'name.min'          => 'El nombre del rol debe tener al menos 5 cáracteres.'
        ];
    }

    public function cancel(){
        $this->reset();
        $this->isEditing  = false;
        $this->isCreating = false;
        $this->resetValidation();
    }

    public function save(){
        $this->validate();
        Role::create(['name' => $this->name, 'guard_name' => 'web']);
        $this->cancel();
        session()->flash('message', 'Rol creado exitosamente');

    }   

    public function edit($id){
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->isEditing = true;
        $this->isCreating = true;
    }

    public function update(){
        $this->validate();
        $role = Role::find($this->role_id);
        $role->update(['name' => $this->name]);
        $this->cancel();
        session()->flash('message','Rol Actualizado.');
    }

    public function delete($id)
    {
        // Evitar borrar el rol de super admin por seguridad
        $role = Role::findById($id);
        if($role->name === 'r_admin') {
            session()->flash('message', 'No se puede eliminar el rol raíz.');
            return;
        }
        $role->delete();
        session()->flash('message', 'Rol eliminado');

    }



}
