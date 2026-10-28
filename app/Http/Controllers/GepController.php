<?php

namespace App\Http\Controllers;

use App\Models\Gep;

class GepController extends Controller
{
    public function index()
    {
        $gepek = Gep::with(['processzor', 'oprendszer'])
            ->paginate(15);

        return view('gepek.index', compact('gepek'));
    }
}
