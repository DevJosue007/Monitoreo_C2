@props(['permission' => null])

@php
    // si no se envia permiso se asume que esta habilitado
    // Si se envia, verificamos con spatie
    $canDelete = $permission ? auth()->user()->can($permission) : true;
@endphp

<button {{ $canDelete ? '' : 'disabled' }}
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-700 
                    active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' .
            ($canDelete
                ? 'inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-red-700 
                    active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
                : 'cursor-not-allowed inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md 
                        font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 focus:bg-slate-700 
                        active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'),
    ]) }}>

    @if (!$canDelete)
        <x-heroicon-s-lock-closed class="w-4 h-4 mr-2 opacity-50" />
    @else
        <svg fill="none" viewBox="0 0 24 24" st roke-width="2" stroke="currentColor" class="size-4 mr-2">
            <path d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
    @endif

    {{ $slot }} Eliminar

</button>
