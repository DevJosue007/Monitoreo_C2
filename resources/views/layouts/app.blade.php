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
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-heroicon-o-presentation-chart-bar class="w-5 h-5 mr-3" />
                    Dashboard
                </x-sidebar-link>

                <x-sidebar-link href="{{ route('reportes.index') }}" :active="request()->routeIs('reportes.*')">
                    <x-heroicon-o-document-text class="w-5 h-5 mr-3" />
                    Reportes
                </x-sidebar-link>

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
                @endrole
            </nav>

            <div class="p-4 border-t border-slate-800">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-slate-400 hover:text-white transition w-full px-y py-2 rounded-lg">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-3" />
                        Cerrar Sesión
                    </button>
                </form>
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
