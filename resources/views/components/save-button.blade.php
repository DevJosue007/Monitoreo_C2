<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-700 
                    active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    ]) }}>

    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
        <path d="m4.5 12.75 6 6 9-13.5" />
    </svg>

    {{ $slot }} Guardar
</button>
