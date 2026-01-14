<?php

use Illuminate\Support\Facades\BD;
use Livewire\Volt\Component;
use Carbon\Carbon;

new class extends Component {

    public function with() : array
    {
        // Datos para las sesiones
        $minsActivo = 15; // Tolerancia
        $umbralActividad = Carbon::now()->subMinutes($minsActivo)->getTimestamp();

        $usersActive = DB::table('sessions')
            ->whereNotNull('user_id') // Solo usuarios autenticados
            ->where('last_activity', '>=', $umbralActividad) //Que tenga actividad reciente
            ->distinct('user_id') // Si un usuario tiene dos pestañas abiertas , cuenta como 1
            ->count('user_id');

        return ['usersActive' => $usersActive];    
    }
}; ?>

<div wire:poll.30s>
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-500">
        <div class="flex items-center">
            <div class="p-3 bg-cyan-100 rounded-full">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600 uppercase"> Usuarios <span class="text-green-600 font-bold">Activos</span></p>
                <p class="text-3xl font-bold text-cyan-800">{{ $usersActive }}</p>
            </div>
        </div>
    </div>
</div>
