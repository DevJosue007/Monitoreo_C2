<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end mb-4">
                {{-- <input type="text" wire:model.live="search" placeholder="Filtrar por etiqueta..."
                    class="rounded-md border-gray-300 shadow-sm"> --}}
                <x-primary-button wire:click="nuevoReporte"
                    class="bg-blue-500 text-white hover:bg-blue-800 px-4 py-2 rounded">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Reporte
                </x-primary-button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left"> Usuario </th>
                                <th class="px-6 py-3 text-left"> Descripción </th>
                                <th class="px-6 py-3 text-left"> Fecha Creación </th>
                                <th class="px-6 py-3 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $r)
                                <tr>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal"> {{ $r->user->name }}
                                    </td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal"> {{ $r->descripcion }}
                                    </td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">
                                        {{ $r->fecha_hora_inc }}</td>
                                    <td class="px-6 py-4 max-w-sm break-words whitespace-normal">
                                        <x-primary-button type="button" wire:click="openGallery({{ $r->id }})">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="size-4 mr-2">
                                                <path
                                                    d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                            </svg>
                                            ({{ $r->media->count() }})
                                        </x-primary-button>

                                        <x-edit-button type="button" wire:click="edit({{ $r->id }})">
                                        </x-edit-button>

                                        <x-delete-button wire:click="delete({{ $r->id }})"
                                            wire:confirm="¿Estas seguro que deseas seliminar este reporte?">
                                        </x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            </div>
        </div>
    </div>





    <!-- Inicio Modal creacion/actualización-->
    @if ($isCreating)

        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="cancel"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg tex-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                            {{ $isEditing ? '- Actualizar' : '- Nuevo' }} Reporte -
                        </h3>

                        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}"
                            class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold">Cento Penitenciario</label>
                                <select wire:model="centroP_id" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccione...</option>
                                    @foreach ($centros as $c)
                                        <option value="{{ $c->item_valor }}"> {{ $c->item_etiqueta }}</option>
                                    @endforeach
                                </select>
                                @error('centroP_id')
                                    <span class="text-red-500"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold"> Bloque </label>
                                <select wire:model="bloque_id" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccione ...</option>
                                    @foreach ($bloques as $b)
                                        <option value="{{ $b->item_valor }}"> {{ $b->item_etiqueta }}</option>
                                    @endforeach
                                </select>
                                @error('bloque_id')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold">Área</label>
                                <select wire:model="area_id" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccione...</option>
                                    @foreach ($areas as $a)
                                        <option value="{{ $a->item_valor }}"> {{ $a->item_etiqueta }} </option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold"> Tipo de Incidente</label>
                                <select wire:model="tipoInc_id" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccione...</option>
                                    @foreach ($tipos as $ti)
                                        <option value="{{ $ti->item_valor }}">{{ $ti->item_etiqueta }}</option>
                                    @endforeach
                                </select>
                                @error('tipoInc_id')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block font-bold"> Descripción</label>
                                <textarea wire:model="descripcion" class="w-full border-gray-300 rounded" rows="3"></textarea>
                                @error('descripcion')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>
                            <div>
                                <label class="block font-bold">Fecha y Hora Incidente</label>
                                <input type="datetime-local" wire:model="fecha_hora"
                                    class="w-full border-gray-300 rounded">
                                @error('fecha_hora')
                                    <label class="text-red-500">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Evidencia (Fotos/videos) </label>
                                <input type="file" wire:model="archivos" multiple
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <div wire:loading wire:target="archivos" class="text-sm text-blue-600 mt-2">
                                    Subiendo archivos, por favor espere...
                                </div>
                                @if ($archivos)
                                    <div class="flex flex-wrap gap-2 mt-4">
                                        @foreach ($archivos as $archivo)
                                            <div class="relative w-24 h-24 border rounded overflow-hidden bg-gray-100">
                                                @if (in_array($archivo->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']))
                                                    <img src="{{ $archivo->temporaryUrl() }}"
                                                        class="object-cover w-full h-full">
                                                @else
                                                    <div
                                                        class="flex items-center justify-center h-full text-[10px] text-center uppercase font-bold">
                                                        {{ $archivo->getClientOriginalExtension() }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @error('archivos.*')
                                    <span class="text-red-500 text-xs"> {{ $message }}</span>
                                @enderror

                            </div>

                            <div class="md:col-span-2 text-right">
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
            </div>
        </div>
    @endif
    <!-- Final Modal creacion/actualización-->

    @if ($showGallery)
        <div class="fixed inset-0 z-[9999] overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity" wire:click="closeGallery"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div
                    class="inline-block align-botton bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6">

                        <div class="flex justify-between items-center mb-4 border-b pb-2">
                            <h3 class="text-xl font-bold text-gray-900"> {{ $reportTitle }}</h3>
                            <button wire:click="closeGallery"
                                class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-4 max-h-[60vh] overflowy-auto p-2">

                            @forelse ($galleryMedia as $file)
                                <div
                                    class="border rounded-lg overflow-hidden bg-black flex items-center justify-center h-64 ">
                                    @if (Str::contains($file->archivo_tipo, 'image'))
                                        <a href="{{ asset('storage/' . $file->archivo_ruta) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $file->archivo_ruta) }}"
                                                class="max-h-64 object-contain hover:scale-105 transition shadow-lg">
                                        </a>
                                    @elseif(Str::contains($file->archivo_tipo, 'video'))
                                        <video controls class="w-full max-h-64">
                                            <source src="{{ asset('storage/' . $file->archivo_ruta) }}"
                                                type="{{ $file->archivo_tiop }}">
                                        </video>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center text-gray-500 col-span-full py-10">
                                    No hay archivos multimedia adjuntos.
                                </p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end">
                        <button wire:click="closeGallery" type="button"
                            class="bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-700">
                            Cerrar Galería
                        </button>
                    </div>

                </div>
            </div>

    @endif


</div>
