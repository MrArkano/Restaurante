<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\ExpansionController;

// Página de bienvenida / Inicio
Route::get('/', [BaseController::class, 'index']);

// Catálogo de productos
Route::get('/productos', [BaseController::class, 'productos']);

// Ludoteca
Route::resource('idiomas', IdiomaController::class);
Route::resource('juegos', JuegoController::class);
Route::resource('expansiones', ExpansionController::class);