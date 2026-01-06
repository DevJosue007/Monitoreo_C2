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
    public $selected_permissions = [];

    public function render()
    {
        return view('livewire.role-index',[
            'roles' => Role::where('name', 'like', '%'.$this->search.'%')->paginate(10),
            'all_permissions' => Permission::all()
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

        $role =Role::create(['name' => $this->name, 'guard_name' => 'web']);

        // Asignar los permisos seleccionados al rol
        if(!empty($this->selected_permissions)){
            $role->syncPermissions($this->selected_permissions);
        }

        $this->cancel();
        session()->flash('message', 'Rol con permisos creado exitosamente');

    }   

    public function edit($id){
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        
        // Cargar los permisos actuales del rol a editar 
        $this->selected_permissions = $role->permissions->pluck('name')->toArray();

        $this->isEditing = true;
        $this->isCreating = true;
    }

    public function update(){
        $this->validate(
            [
                'name' => 'required|alpha_dash|max:255|min:5|unique:roles,name,'.$this->role_id
            ],
            [
                'name.required'     => 'Favor de ingresar un nombre al nuevo rol.',
                'name.unique'       => 'Rol duplicado, favor de cambiarlo.',
                'name.alpha_dash'   => 'No se permiten caracteres especiales.',
                'name.max'          => 'El nombre del rol no puede superar los 255 cáracteres.',
                'name.min'          => 'El nombre del rol debe tener al menos 5 cáracteres.'
            ]

        );
        $role = Role::find($this->role_id);
        $role->update(['name' => $this->name]);
        // Sincronizar permisos (quita los que ya no estan y agrega los nuevos)
        $role->syncPermissions($this->selected_permissions);
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
