<div>{{--  DIV RAíZ --}}
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('message') }}
            </div>
        @endif
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold">Gestión de Roles</h1>
                <button type="button" wire:click="nuevoRol" class="bg-indigo-600 text white px-2 py-2 rounded shadow">
                    Nuevo Rol
                </button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <input type="text" wire:model.live="search" class="mb-4 rounded border-gray-300 w-full sw:w-1/3">

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Nombre del Rol</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr class="border-b">
                            <td class="p-3">{{ $role->id }}</td>
                            <td class="p-3 font-semibold"> {{ $role->name }}</td>
                            <td class="p-3">
                                <button type="button" wire:click="edit({{ $role->id }})" class="text-orange-600 hover:text-orange-900">Editar</button>
                                <button type="button" wire:confirm="¿Estás Seguro?" wire:click="delete({{ $role->id }})" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </td>
                        </tr>
                            
                        @endforeach

                    </tbody>
                </table>                
                <div class="mt-4">{{ $roles->links() }}</div>
            </div>
        </div>
    </div>


   @if($isCreating)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-96 shadow-2xl">
            <h2 class="text-xl font-bold mb-4">{{ $isEditing ? 'Editar' : 'Nuevo' }} Rol</h2>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                <label class="block text-sm font-medium text-gray-700">Nombre del Rol</label>
                <input type="text" wire:model="name" class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div class="mt-6 flex justify-end space-x-2">
                    <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    @endif




</div>
