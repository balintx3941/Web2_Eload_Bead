<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\GepController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('persons', PersonController::class);

Route::get('/gepek', [GepController::class, 'index'])
    ->name('gepek.index');
