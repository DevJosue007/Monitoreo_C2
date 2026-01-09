<div>
   @props(['active', 'href'])

   @php
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg transition duration-200'
        : 'flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200';
   @endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes] ) }}> 
    {{ $slot }}
</a>

</div>