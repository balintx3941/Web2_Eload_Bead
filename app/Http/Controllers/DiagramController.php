<?php

namespace App\Http\Controllers;

use App\Models\Gep;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index()
    {
        $adatok = Gep::query()
            ->select('gyarto', DB::raw('COUNT(*) as darab'))
            ->groupBy('gyarto')
            ->orderBy('gyarto')
            ->get();

        $gyartok = $adatok->pluck('gyarto');
        $darabok = $adatok->pluck('darab');

        return view('gepek.diagram', compact('gyartok', 'darabok'));
    }
}
