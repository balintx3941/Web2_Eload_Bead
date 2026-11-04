<?php

namespace App\Http\Controllers;

use App\Models\KapcsolatUzenet;
use Illuminate\Http\Request;

class KapcsolatController extends Controller
{
    public function index()
    {
        return view('kapcsolat');
    }

    public function kuldes(Request $request)
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'targy' => ['required', 'string', 'max:150'],
            'uzenet' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'email.required' => 'Az e-mail-cím megadása kötelező.',
            'email.email' => 'Adj meg egy érvényes e-mail-címet.',
            'targy.required' => 'A tárgy megadása kötelező.',
            'uzenet.required' => 'Az üzenet megadása kötelező.',
            'uzenet.min' => 'Az üzenet legalább 10 karakter legyen.',
        ]);

        KapcsolatUzenet::create($adatok);

        return redirect()
            ->route('kapcsolat.index')
            ->with('siker', 'Az üzenetedet sikeresen elküldtük.');
    }
}
