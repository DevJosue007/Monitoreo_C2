@props(['permission' => null])

@php
    // si no se envia permiso se asume que esta habilitado
    // Si se envia, verificamos con spatie
    $canEdit = $permission ? auth()->user()->can($permission) : true;
@endphp


<button {{ $canEdit ? '' : 'disabled' }}
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-800 focus:bg-amber-700 
                    active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' .
            ($canEdit
                ? 'inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-800 focus:bg-amber-700 
                    active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
                : 'cursor-not-allowed inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 focus:bg-slate-700 
                    active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'),
    ]) }}>

    @if (!$canEdit)
        <x-heroicon-s-lock-closed class="w-4 h-4 mr-2 opacity-50"/>
    @else
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
            <path d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg>
    @endif

    {{ $slot }} Editar
</button>
