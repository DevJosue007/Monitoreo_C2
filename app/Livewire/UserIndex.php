<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserIndex extends Component
{
    use WithPagination;

    public $name, $email, $passport, $role_id, $user_id;
    public $isCreating = false;
    public $isEditing = false;
    public $search = '';

    public function cancel(){
        $this->reset();
        $this->resetValidation();
        $this->isCreating = false;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.user-index',[
            'users' => User::with('roles')
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->paginate(10),
            'roles' => Role::all(),
        ])->layout('layouts.app');
    }

    public function save(){

        $this->validate([
            'name'     => 'required|string|max:255|min:10',
            'email'    => 'required|email|unique:users,email',  
            'password' => ['required', Password::defaults()],
            'role_id'  => 'required|exist:roles,id'
        ]);

        $this->messages([
            'name.required'=> 'Se debe ingresar el nombre.',
            'name.string'  => 'El tipo de dato debe ser texto.',
            'name.max'     => 'El nombre no debe pasar de 255 caracteres.',
            'name.min'     => 'El nombre debe contener minimo 10 caracteres.',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'passowrd' => Hash::make($this->password),
        ]);

        $role = Role::findById($this->role_id);
        $user->assignRole($role);

        $this->cancel();
        session()->flash('message', 'Usuario creado correctamente');
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name    = $user->name;
        $this->email   = $user->email;

        $this->role_id = $user->roles->first()?->id;
        
        $this->isEditing = true;
        $this->isCreating = true;

    }

    public function update(){
        $user = USer::findOrFail($this->user_id);

        $this->validate([
            'name'    => 'required|string|max:255|min:10',
            'email'   => 'required|email|unique:users,email,'.$user->id,
            'pasword' => ['nullable', Password::defaults()],
            'role_id' => 'required|exist:roles,id',
        ]);

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
        ];
        // Solo se actualiza la contraseña si se escribio algo
        if($this->password){
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        //sincronizar roles (borra los anteriores y pone el nuevo)
        $role = Role::findById($this->role_id);
        $user->syncRoles([$role->name]);

        $this->cancel();
        session()->flash('message', 'usuario actualizado');


    }




}
