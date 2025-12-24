<div> <!-- INICIO DIV RAIZ -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="flex justify-between mb-4">
                <input type="text" wire:model.live="search" placeholder="Buscar catálogo..." class="rounded-md border-gray-300 shadow-sm">
                <button wire:click="nuevoItem"
                    class="bg-blue-600 text-white hover:bg-blue-800 px-4 py-2 rounded">
                    + Nuevo Item
                </button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">Definición</th>
                            <th class="px-6 py-3 text-left">Etiqueta</th>
                            <th class="px-6 py-3 text-left">Valor</th>
                            <th class="px-6 py-3 text-left">Estatus</th>
                            <th class="px-6 py-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $item->definicion }}</td>
                                <td class="px-6 py-4">{{ $item->item_etiqueta }}</td>
                                <td class="px-6 py-4">{{ $item->item_valor }}</td>
                                <td class="px-6 py-4">
                                    <span class="{{ $item->estatus ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->estatus ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button type="button" wire:click="edit({{ $item->id }})"
                                        class="text-blue-600 mr-2">Editar</button>
                                    <button wire:click="delete({{ $item->id }})" wire:confirm="¿eliminar?"
                                        class="text red 600">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>

        </div>

    </div>


    @if ($isCreating)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-2xl">
                <h2 class="text-xl font-bold mb-4"> {{ $isEditing ? 'Editar' : 'nuevo' }} Item</h2>

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
                            <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    @endif






</div> <!-- FIN DIV RAIZ -->
