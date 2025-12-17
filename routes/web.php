<?php

use App\Livewire\ReportIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    //------ Rutas operadores y admin -------
    // Grupo de reportes
    Route::get('/reportes', ReportIndex::class)->name('reportes.index');

    //------ Rutas admin -------------------

    // Grupo de catálogos
    Route::middleware(['role:rol_admin'])->prefix('catalogos')->name('catalogos.')->group(function(){
        Route::get('/', function(){ return "Gestion de catálogos";})->name('index');
    });

    // Grupo de usuarios/roles 
    Route::middleware(['role:rol_admin'])->prefix('configuracion')->name('config.')->group(function(){
        Route::get('/usuarios', function(){ return "Gestion de Usuarios";})->name('users');
        Route::get('/roles', function(){ return "Gestion de roles"; })->name('roles');
    });



});