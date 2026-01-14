<div>{{--  DIV RAíZ --}}
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-title>
                <x-slot name="icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </x-slot>
                Roles y permisos
            </x-section-title>



            <div class="flex justify-between mb-4">
                <input type="text" wire:model.live="search" placeholder="Filtrar por rol..."
                    class="rounded-md border-gray-300 shadow-sm">
                <x-primary-button wire:click="nuevoRol">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
                        <path d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Rol
                </x-primary-button>

            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Rol</th>
                                <th class="px-6 py-3 text-left">Permisos Asignados</th>
                                <th class="px-6 py-3 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr class="border-b">
                                    <td class="p-3 font-semibold"> {{ $role->name }}</td>
                                    <td class="p-3 font-semibold"></td>
                                    <td class="p-3">
                                        <x-edit-button type="button" wire:click="edit({{ $role->id }})">
                                        </x-edit-button>

                                        <x-delete-button type="button"
                                            wire:click="$dispatch('confirmDelete',{id: {{ $role->id }}})">
                                        </x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>


    @if ($isCreating)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-96 shadow-2xl">
                <h2 class="text-xl font-bold mb-4 text-center">{{ $isEditing ? '- Actualizar' : '- Nuevo' }} Rol - </h2>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" wire:model="name"
                            class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500">
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-5">
                        <label class="block text-sm font-medium text-gray-700"> Permisos:</label>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-2 p-3 bg-gray-50 rounded-lg border max-h-60 overflow-y-auto">
                            @foreach ($all_permissions as $permission)
                                <label for=""
                                    class="flex items-center space-x-3 p-2 hover:bg-white rounded transition">
                                    <input type="checkbox" wire:model="selected_permissions"
                                        value="{{ $permission->name }}"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @if (empty($selected_permissions))
                            <p class="text-xs text-amber-600 mt-1 italic">
                                No se asignan permisos de forma predeterminada
                            </p>
                        @endif
                    </div>


                    <div class="mt-6 flex justify-end space-x-2">
                        <x-cancel-button wire:click="cancel"></x-cancel-button>

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
