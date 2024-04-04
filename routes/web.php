<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;

Route::get('/', function () {
    return view('app');
});

// Dentro do arquivo routes/web.php
Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::get('/', [CargoController::class, 'index']);

//Route::get('/cargos', 'App\Http\Controllers\CargoController@index')->name('cargos.index');

//Route::post('/cargos', 'CargoController@store')->name('cargos.store');
Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');

