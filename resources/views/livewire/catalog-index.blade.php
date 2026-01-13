<div> <!-- INICIO DIV RAIZ -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <input type="text" wire:model.live="search" placeholder="Filtrar por etiqueta..."
                    class="rounded-md border-gray-300 shadow-sm">
                <x-primary-button wire:click="nuevoItem"
                    class="bg-blue-500 text-white hover:bg-blue-800 px-4 py-2 rounded">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo item
                </x-primary-button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">DEFINICIÓN</th>
                                <th class="px-6 py-3 text-left">ETIQUETA</th>
                                <th class="px-6 py-3 text-left">VALOR</th>
                                <th class="px-6 py-3 text-left">ESTATUS</th>
                                <th class="px-6 py-3 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">{{ $item->definicion }}
                                    </td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">
                                        {{ $item->item_etiqueta }}</td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">{{ $item->item_valor }}
                                    </td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal font-bold">
                                        <span class="{{ $item->estatus ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->estatus ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center max-w-sm break-words whitespace-normal">
                                        <x-edit-button type="button"
                                            wire:click="edit({{ $item->id }})">
                                        </x-edit-button>

                                        <x-delete-button wire:click="delete({{ $item->id }})"
                                            wire:confirm="¿eliminar?">
                                        </x-delete-button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $items->links() }}
            </div>

        </div>

    </div>


    @if ($isCreating)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-2xl">
                <h2 class="text-xl font-bold mb-4 text-center"> {{ $isEditing ? '- Actualizar' : '- Nuevo' }} Item -
                </h2>

                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}">
                    <div class="space-y-4">
                        <div>
                            <label> Definición (Grupo) </label>
                            <input type="text" wire:model="definicion" class="w-full rounded border-gray-300">
                            @error('definicion')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label>Etiqueta (Lo que se ve)</label>
                            <input type="text" wire:model="item_etiqueta" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label>Valor (Código interno)</label>
                            <input type="text" wire:model="item_valor" class="w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label>Estatus</label>
                            <select wire:model="estatus" class="w-full rounded border-gray-300">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="mt-6 flex justify-end gap-2">
                            <x-cancel-button wire:click="cancel"> </x-cancel-button>
                            
                            @if ($isEditing)
                                <x-edit-button></x-edit-button>
                            @else
                                <x-save-button></x-save-button>
                            @endif


                        </div>
                    </div>
                </form>


            </div>
        </div>
    @endif






</div> <!-- FIN DIV RAIZ -->
