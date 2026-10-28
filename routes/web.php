<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\GepController;
use App\Http\Controllers\KapcsolatController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('persons', PersonController::class);

Route::get('/gepek', [GepController::class, 'index'])
    ->name('gepek.index');


Route::get('/kapcsolat', [KapcsolatController::class, 'index'])
    ->name('kapcsolat.index');

Route::post('/kapcsolat', [KapcsolatController::class, 'kuldes'])
    ->name('kapcsolat.kuldes');
