<div> {{-- DIV RAIZ --}}
    <div class="py-2">
        <div class="mx-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-title>
                <x-slot name="icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </x-slot>
                Usuarios Registrados
            </x-section-title>

            <div class="flex justify-between mb-4">
                <input type="text" wire:model.live="search" placeholder="Buscar..."
                    class="rounded-md border-gray-300 shadow-sm">
                <x-primary-button wire:click="nuevoUsuario">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
                        <path d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Usuario
                </x-primary-button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left"> Nombre</th>
                                <th class="px-6 py-3 text-left"> Email </th>
                                <th class="px-6 py-3 text-left"> Rol </th>
                                <th class="px-6 py-3 text-left"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal"> {{ $user->name }}</td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal"> {{ $user->email }}</td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">
                                        {{ $user->getRoleNames()->implode(', ') }}
                                    </td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">
                                        <x-edit-button type="button" wire:click="edit({{ $user->id }})">
                                        </x-edit-button>

                                        <x-delete-button wire:click="delete( {{ $user->id }})"
                                            wire:confirm="¿Estás seguro de que deseas eliminar permanentemente al usuario?">
                                        </x-delete-button>
                                      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @if ($isCreating)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-2xl">
                <h2 class="text-xl font-bold mb-4 border-b pb-2 text-gray-800">
                    {{ $isEditing ? '- Actualizar' : '- Nuevo' }} Usuario - 
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
                                    <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Contraseña {{ $isEditing ? '(Dejar vacio para no cambiar)' : '' }}
                            </label>
                            <input type="password" wire:model="password" class="w-full rounded-md border-gray-300">
                            @error('password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                        <x-cancel-button wire:click="cancel"> </x-cancel-button>
                        
                        @if ($isEditing)
                            <x-edit-button></x-edit-button>
                        @else
                            <x-save-button></x-save-button>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    @endif




</div>
