<?php

namespace App\Http\Controllers;

use App\Models\Gep;
use App\Models\Processzor;
use App\Models\Oprendszer;
use Illuminate\Http\Request;

class GepController extends Controller
{
    // Gépek listázása
    public function index()
    {
        $gepek = Gep::with(['processzor', 'oprendszer'])
            ->paginate(15);

        return view('gepek.index', compact('gepek'));
    }

    // Új gép felviteli űrlapja
    public function create()
    {
        $processzorok = Processzor::all();
        $oprendszerek = Oprendszer::all();

        return view('gepek.create', compact(
            'processzorok',
            'oprendszerek'
        ));
    }

    // Új gép mentése
    public function store(Request $request)
    {
        $adatok = $request->validate([
            'gyarto' => ['required', 'string', 'max:255'],
            'tipus' => ['required', 'string', 'max:255'],
            'kijelzo' => ['required', 'string', 'max:255'],
            'memoria' => ['required', 'string', 'max:255'],
            'merevlemez' => ['required', 'string', 'max:255'],
            'videovezerlo' => ['required', 'string', 'max:255'],
            'ar' => ['required', 'numeric', 'min:0'],
            'processzorid' => ['required', 'exists:processzorok,id'],
            'oprendszerid' => ['required', 'exists:oprendszerek,id'],
            'db' => ['required', 'integer', 'min:0'],
        ]);

        Gep::create($adatok);

        return redirect()
            ->route('gepek.index')
            ->with('siker', 'A gép sikeresen hozzáadva.');
    }

    // Meglévő gép adatainak szerkesztőűrlapja
    public function edit($id)
    {
        $gep = Gep::findOrFail($id);

        $processzorok = Processzor::all();
        $oprendszerek = Oprendszer::all();

        return view('gepek.edit', compact(
            'gep',
            'processzorok',
            'oprendszerek'
        ));
    }

    // Módosított gép adatainak mentése
    public function update(Request $request, $id)
    {
        $gep = Gep::findOrFail($id);

        $adatok = $request->validate([
            'gyarto' => ['required', 'string', 'max:255'],
            'tipus' => ['required', 'string', 'max:255'],
            'kijelzo' => ['required', 'string', 'max:255'],
            'memoria' => ['required', 'string', 'max:255'],
            'merevlemez' => ['required', 'string', 'max:255'],
            'videovezerlo' => ['required', 'string', 'max:255'],
            'ar' => ['required', 'numeric', 'min:0'],
            'processzorid' => ['required', 'exists:processzorok,id'],
            'oprendszerid' => ['required', 'exists:oprendszerek,id'],
            'db' => ['required', 'integer', 'min:0'],
        ]);

        $gep->update($adatok);

        return redirect()
            ->route('gepek.index')
            ->with('siker', 'A gép adatai sikeresen módosultak.');
    }

    // Gép törlése
    public function destroy($id)
    {
        $gep = Gep::findOrFail($id);

        $gep->delete();

        return redirect()
            ->route('gepek.index')
            ->with('siker', 'A gép sikeresen törölve.');
    }
}
