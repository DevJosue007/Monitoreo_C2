<?php

use App\Livewire\CatalogIndex;
use App\Livewire\ReportIndex;
use App\Livewire\RoleIndex;
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

    Route::get('/reportes', ReportIndex::class)->name('reportes.index');

    Route::middleware(['auth', 'role:r_admin'])->prefix('catalogos')->name('catalogos.')->group(function(){
        Route::get('/', CatalogIndex::class)->name('index');
    });

    Route::middleware(['auth', 'role:r_admin'])->prefix('roles')->name('roles.')->group(function(){
        Route::get('/', RoleIndex::class)->name('index');
    });

});