<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
    <div class="mb-6">
        <button wire:click="nuevoReporte" 
            class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition" >
           Nuevo Reporte
        </button>
    </div>

    @if($isCreating)
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 border-t-4 border-indigo-500">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        @foreach($bloques as $b) 
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
                        @foreach($areas as $a)
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
                        @foreach($tipos as $ti)
                            <option value="{{ $ti->item_valor}}">{{$ti->item_etiqueta}}</option>
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
                    <input type="datetime-local" wire:model="fecha_hora" class="w-full border-gray-300 rounded">
                    @error('fecha_hora')
                        <label class="text-red-500">{{ $message }}</label>
                    @enderror                       
                </div>
                <div class="md:col-span-2 text-right">
                    <button wire:click="cancel"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="{{ $isEditing ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' }}  text-white px-6 py-2 rounded"> 
                        {{ $isEditing ? 'Actualizar' : 'Guardar'}}
                    </button>
                </div>
            </form>
        </div>
    @endif


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase"> ID </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase"> Usuario </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase"> Descripción </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase"> Fecha </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">  </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reports as $r)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"> {{ $r->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"> {{ $r->user->name }}</td>
                        <td class="px-6 py-4 "> {{ $r->descripcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"> {{ $r->fecha_hora_inc }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button 
                                wire:click="edit({{ $r->id }})"
                                class="text-blue-600 hover:text-blue-900 font-bold">
                                Editar
                            </button>
                            <button 
                                wire:click="delete({{ $r->id }})" 
                                wire:confirm="¿Estas seguro que deseas seliminar este reporte?"
                                class="text-red-600 hover:text-red-900 font-bold">
                                Eliminar
                            </button>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
