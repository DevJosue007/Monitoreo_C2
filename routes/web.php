<?php

use App\Livewire\CatalogIndex;
use App\Livewire\ReportIndex;
use App\Livewire\RoleIndex;
use App\Livewire\UserIndex;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');

Route::get('/', function(){
    if(auth()->check()){
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


// Se valida que el usuario este logeado y verificado
Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/reportes', ReportIndex::class)->name('reportes.index');

    // Se valida que tenga el rol de admin

    Route::middleware(['role:r_admin'])->group(function(){

        Route::prefix('catalogos')->name('catalogos.')->group(function(){
            Route::get('/', CatalogIndex::class)->name('index');
        });
        
        Route::prefix('roles')->name('roles.')->group(function(){
            Route::get('/', RoleIndex::class) ->name('index');
        });

        Route::prefix('usuarios')->name('usuarios.')->group(function(){
            Route::get('/', UserIndex::class)->name('index');
        });

    });


});