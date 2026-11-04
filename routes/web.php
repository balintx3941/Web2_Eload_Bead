<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Api\GepController as ApiGepController;
use App\Models\Gep;
use App\Models\Processzor;
use App\Models\Oprendszer;
use Illuminate\Http\Request;

// Főoldal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Vendég útvonalak (Autentikáció)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Adatbázis alias
Route::get('/adatbazis', function () {
    return redirect()->route('gepek.index');
})->name('adatbazis');

// Gépek CRUD
Route::get('/gepek', function () {
    $gepek = Gep::with(['processzor', 'oprendszer'])->paginate(15);
    return view('gepek.index', compact('gepek'));
})->name('gepek.index');

Route::get('/gepek/create', function () {
    $processzorok = Processzor::all();
    $oprendszerek = Oprendszer::all();
    return view('gepek.create', compact('processzorok', 'oprendszerek'));
})->name('gepek.create');

Route::post('/gepek', function (Request $request) {
    $adatok = $request->validate([
        'gyarto' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'kijelzo' => 'required|numeric|min:0',
        'memoria' => 'required|integer|min:0',
        'merevlemez' => 'required|integer|min:0',
        'videovezerlo' => 'required|string|max:255',
        'ar' => 'required|numeric|min:0',
        'processzorid' => 'required',
        'oprendszerid' => 'required',
        'db' => 'required|integer|min:0',
    ]);
    Gep::create($adatok);
    return redirect()->route('gepek.index')->with('siker', 'A gép sikeresen hozzáadva.');
})->name('gepek.store');

Route::get('/gepek/{id}/edit', function ($id) {
    $gep = Gep::findOrFail($id);
    $processzorok = Processzor::all();
    $oprendszerek = Oprendszer::all();
    return view('gepek.edit', compact('gep', 'processzorok', 'oprendszerek'));
})->name('gepek.edit');

Route::put('/gepek/{id}', function (Request $request, $id) {
    $gep = Gep::findOrFail($id);
    $adatok = $request->validate([
        'gyarto' => 'required|string|max:255',
        'tipus' => 'required|string|max:255',
        'kijelzo' => 'required|numeric|min:0',
        'memoria' => 'required|integer|min:0',
        'merevlemez' => 'required|integer|min:0',
        'videovezerlo' => 'required|string|max:255',
        'ar' => 'required|numeric|min:0',
        'processzorid' => 'required',
        'oprendszerid' => 'required',
        'db' => 'required|integer|min:0',
    ]);
    $gep->update($adatok);
    return redirect()->route('gepek.index')->with('siker', 'A gép adatai sikeresen módosultak.');
})->name('gepek.update');

Route::delete('/gepek/{id}', function ($id) {
    $gep = Gep::findOrFail($id);
    $gep->delete();
    return redirect()->route('gepek.index')->with('siker', 'A gép sikeresen törölve.');
})->name('gepek.destroy');

// Diagram
Route::get('/diagram', function () {
    $adatok = Gep::query()
        ->select('gyarto', \Illuminate\Support\Facades\DB::raw('COUNT(*) as darab'))
        ->groupBy('gyarto')
        ->orderBy('gyarto')
        ->get();

    $gyartok = $adatok->pluck('gyarto');
    $darabok = $adatok->pluck('darab');

    return view('gepek.diagram', compact('gyartok', 'darabok'));
})->name('diagram.index');

// Kapcsolat és üzenetek
Route::get('/kapcsolat', [ContactController::class, 'create'])->name('kapcsolat.index');
Route::post('/kapcsolat', [ContactController::class, 'store'])->name('kapcsolat.kuldes');
Route::get('/uzenetek', [ContactController::class, 'index'])->name('uzenetek');

// Kalkulátor és teszt
Route::get('/teszt', [CalculatorController::class, 'index'])->name('teszt');
Route::post('/teszt', [CalculatorController::class, 'calculate']);

// React felület és REST API
Route::get('/react', function () {
    return view('react');
})->name('react');

Route::prefix('api')->group(function () {
    Route::get('/gepek', [ApiGepController::class, 'index']);
    Route::post('/gepek', [ApiGepController::class, 'store']);
    Route::put('/gepek/{id}', [ApiGepController::class, 'update']);
    Route::delete('/gepek/{id}', [ApiGepController::class, 'destroy']);
});