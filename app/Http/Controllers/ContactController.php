<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 5. Kapcsolat űrlap
    public function create()
    {
        return view('kapcsolat');
    }

    // 5. Üzenet mentése az adatbázisba
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nev' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'uzenet' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'nev.min' => 'A névnek legalább 3 karakterből kell állnia.',
            'email.required' => 'Az e-mail cím megadása kötelező.',
            'email.email' => 'Valós e-mail címet adj meg.',
            'uzenet.required' => 'Az üzenet szövege kötelező.',
            'uzenet.min' => 'Az üzenetnek legalább 10 karakter hosszúnak kell lennie.',
        ]);

        Message::create($validated);

        return back()->with('success', 'Köszönjük az üzenetet! Munkatársunk hamarosan felveszi Önnel a kapcsolatot.');
    }

    // 7. Üzenetek listázása fordított időrendben (legfrissebb elöl)
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('uzenetek', compact('messages'));
    }
}