<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md 
                font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:bg-gray-700 
                active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    ]) }}>

    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 mr-2">
        <path d="M6 18 18 6M6 6l12 12" />
    </svg>

    {{ $slot }} Cancelar
</button>
