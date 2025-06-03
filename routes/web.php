<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController; 
use App\Http\Controllers\PlataformaController;

Route::get('/', function () {
    return redirect()->route('videojuegos.index');
});

// Rutas de recursos para Videojuegos
Route::resource('videojuegos', VideojuegoController::class);

// Rutas de recursos para Plataformas
Route::resource('plataformas', PlataformaController::class);