<div> {{-- DIV RAIZ --}}

 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        {{ session('error') }}
    </div>
@endif
    </div>


    <div class="py-12">
        <div class="mx-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold text-gray-800"> Usuarios del Sistema</h1>
                <button type="button" wire:click="nuevoUsuario"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow">
                    Nuevo Usuario
                </button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <input type="text" wire:model.live="search" placeholder="Buscar por nombre o correo..."
                    class="mb-4 w-full md:w-1/3 rounded-md border-gray-300 shadow-sm">
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Rol
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"> {{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"> {{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->getRoleNames()->implode(', ') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="edit({{ $user->id }})"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3 font-medium">
                                    Editar
                                </button>
                                <button wire:click="delete( {{ $user->id }})"
                                    wire:confirm="¿Estás seguro de que deseas eliminar permanentemente al usuario?"
                                    class="text-red-600 hover:text-red-900 font-medium">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>

    @if ($isCreating)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-2xl">
                <h2 class="text-xl font-bold mb-4 border-b pb-2 text-gray-800">
                    {{ $isEditing ? 'Actualizar' : 'Registrar' }}
                </h2>

                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                    <div class="space-y-4">
                        <div>
                            <label for="" class="block text-sm font-medium text-gray-700"> Nombre
                                Completo</label>
                            <input type="text" wire:model="name" class="w-full rounded-md border-gray-300">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                            <input type="email" wire:model="email" class="w-full rounded-md border-gray-300">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700"> Rol Asignado</label>
                            <select wire:model="role_id" class="w-full rounded-md border-gray-300">
                                <option value="">Seleccione un rol...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"> {{ $role->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Contraseña {{ $isEditing ? '(Dejar vacio para no cambiar)' : ''}}
                            </label>
                            <input type="password" wire:model="password" class="w-full rounded-md border-gray-300">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                        <button type="button" wire:click="cancel" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500"> Cancelar</button>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            {{ $isEditing ? 'Guardar Cambios' : 'Crear Usuario' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif




</div>
