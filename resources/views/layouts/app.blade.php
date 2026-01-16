<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="flex h-screen bg-gray-100 overflow-hidden">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col h-screen sticky top-0">
            <div class="p-6 flex items-center space-x-2 border-b border-slate-800">
                <x-application-logo class="h-8 w-auto fill-current text-indigo-500" />
                <span class="text-xl font-bold tracking-wider"> Monitoreo</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="text-xs font-semibold text-slate-500 uppercase mt-6 mb-2 ml-2">MÓDULOS</p>
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-heroicon-o-presentation-chart-bar class="w-5 h-5 mr-3" />
                    Dashboard
                </x-sidebar-link>

                @hasanyrole('r_admin|reportes_n1|reportes_n2')
                <x-sidebar-link href="{{ route('reportes.index') }}" :active="request()->routeIs('reportes.*')">
                    <x-heroicon-o-document-text class="w-5 h-5 mr-3" />
                    Reportes
                </x-sidebar-link>
                @endhasanyrole

                @role('r_admin')
                    <p class="text-xs font-semibold text-slate-500 uppercase mt-6 mb-2 ml-2">Configuración</p>
                    <x-sidebar-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                        <x-heroicon-o-key class="w-5 h-5 mr-3" />
                        Roles y Permisos
                    </x-sidebar-link>

                    <x-sidebar-link href="{{ route('catalogos.index') }}" :active="request()->routeIs('catalogos.*')">
                        <x-heroicon-o-square-3-stack-3d class="w-5 h-5 mr-3" />
                        Catálogos
                    </x-sidebar-link>

                    <x-sidebar-link href=" {{ route('usuarios.index') }}" :active="request()->routeIs('usuarios.*')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 mr-2">
                            <path d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Usuarios
                    </x-sidebar-link>
                @endrole
            </nav>

            <div class="p-4 border-t border-slate-800" x-data="{ open: false }">

                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center w-full p-2 rounded-xl hover:bg-slate-800 transition duration-200 group">

                    <div
                        class="h-10 w-10 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold shado-lg shado-blue-500/20 group-hover:scale-105 transition-transform">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="ml-3 text-left">
                        <p class="text-sm font-bold text-white leading-none"> {{ Auth::user()->name }} </p>
                        {{-- <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-tighter">Administrador</p>                     --}}
                    </div>
                    <x-heroicon-s-chevron-up class="w-4 h-4 ml-auto text-slate-500 transition-transform"
                        ::class="open ? 'rotate-180' : ''" />
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100" class="mb-2 space-y-1">

                    <a href="{{ route('profile') }}" wire:navigate
                        class="flex items-center px-4 py-2 text-sm text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                        <x-heroicon-o-user-circle class="w-5 h-5 mr-3" />
                        Mi Perfil
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center px-4 py-2 text-sm text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-3" />
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>


    {{-- Importación de SweetAlert2 --}}
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].icon,
                confirmButtonColor: '#4f46e5',
            });
        });

        window.addEventListener('swal:toast', event => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: event.detail[0].icon,
                title: event.detail[0].title
            });
        });

        // Manejador de modales para eliminar
        window.addEventListener('confirmDelete', event => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esta acción!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed', {
                        id: event.detail.id
                    });
                }
            });
        });
    </script>





</body>

</html>
