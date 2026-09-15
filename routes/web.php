<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\ExpansionController;
use App\Http\Controllers\BusquedaController;
use Illuminate\Support\Facades\Route;

// Página de bienvenida / Inicio
Route::get('/', [BaseController::class, 'index']);
Route::get('/productos', [BaseController::class, 'productos']);

// Rutas para Idiomas
Route::get('/idiomas/crear', [IdiomaController::class, 'create'])->name('idiomas.create');
Route::get('/idiomas/create', [IdiomaController::class, 'create']); // alias de compatibilidad
Route::get('/idiomas', [IdiomaController::class, 'index'])->name('idiomas.index');
Route::post('/idiomas', [IdiomaController::class, 'store'])->name('idiomas.store');
Route::get('/idiomas/{idioma}', [IdiomaController::class, 'show'])->name('idiomas.show');
Route::put('/idiomas/{idioma}', [IdiomaController::class, 'update'])->name('idiomas.update');
Route::delete('/idiomas/{idioma}', [IdiomaController::class, 'destroy'])->name('idiomas.destroy');

// Rutas para Juegos
Route::get('/juegos/crear', [JuegoController::class, 'create'])->name('juegos.create');
Route::get('/juegos/create', [JuegoController::class, 'create']); // alias de compatibilidad
Route::get('/juegos', [JuegoController::class, 'index'])->name('juegos.index');
Route::post('/juegos', [JuegoController::class, 'store'])->name('juegos.store');
Route::get('/juegos/{juego}', [JuegoController::class, 'show'])->name('juegos.show');
Route::put('/juegos/{juego}', [JuegoController::class, 'update'])->name('juegos.update');
Route::delete('/juegos/{juego}', [JuegoController::class, 'destroy'])->name('juegos.destroy');

// Rutas para Expansiones
Route::resource('expansiones', ExpansionController::class);

// Búsqueda avanzada
Route::get('/busqueda', [BusquedaController::class, 'index'])->name('busqueda.index');