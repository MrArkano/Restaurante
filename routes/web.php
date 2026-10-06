<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PlatoController::class)->group(function () {
    Route::get('platos', 'index')->name('platos.index');
    Route::get('platos/crear', 'create')->name('platos.create');
    Route::post('platos', 'store')->name('platos.store');
    Route::get('platos/{plato}/editar', 'edit')->name('platos.edit');
    Route::put('platos/{plato}', 'update')->name('platos.update');
    Route::delete('platos/{plato}', 'destroy')->name('platos.destroy');
});

Route::controller(MenuController::class)->group(function () {
    Route::get('menu', 'index')->name('menu.index');
    Route::get('menu/{plato}', 'show')->name('menu.show');
});
