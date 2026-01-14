@props(['icon'])

<div class="flex flex-col items-center justify-center py-6">
    <div class="flex items-center space-x-3">
    
        <div class="p-3 bg-blue-100 text-blue-600 rounded-2xl shadow-sm">
            {{ $icon }}
        </div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight uppercase">
            {{ $slot}}
        </h2>
    </div>
    <div class="mt-4 w-96 h-1.5 bg-blue-500 rounded-full opacity-20"></div>    

</div>