<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
</div>@props(['permission' => null])

@php
    // si no se envia permiso se asume que esta habilitado
    // Si se envia, verificamos con spatie
    $canCreate = $permission ? auth()->user()->can($permission) : true;
@endphp

<button {{ $canCreate ? '' : 'disabled' }}
    {{ $attributes->merge([
        'type' => 'submit',
        'class' =>
            'inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md 
                font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-700 
                active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' .
            ($canCreate
                ? 'inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md 
                font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-700 
                active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
                : 'cursor-not-allowed inline-flex items-center px-4 py-2 bg-slate-500 border border-transparent rounded-md 
                            font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 focus:bg-slate-700 
                            active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'),
    ]) }}>
    {{ $slot }}

    @if (!$canCreate)
        <x-heroicon-s-lock-closed class="w-4 h-4 mr-2 opacity-50" />
    @else
        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
            <path d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    @endif


    Nuevo

</button>
