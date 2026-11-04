<?php

namespace App\Http\Controllers;

use App\Services\CalculatorService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('teszt');
    }

    public function calculate(Request $request, CalculatorService $calculator)
    {
        $validated = $request->validate([
            'a' => ['required', 'numeric'],
            'operation' => ['required', 'in:+,-,*,/'],
            'b' => ['required', 'numeric'],
        ], [
            'a.required' => 'Az első szám megadása kötelező.',
            'a.numeric'  => 'Az első értéknek számnak kell lennie.',
            'b.required' => 'A második szám megadása kötelező.',
            'b.numeric'  => 'A második értéknek számnak kell lennie.',
            'operation.required' => 'Válassz ki egy műveletet.',
        ]);

        try {
            $result = $calculator->calculate(
                (float)$validated['a'],
                (float)$validated['b'],
                $validated['operation']
            );

            return back()
                ->withInput()
                ->with('result', $result);
        } catch (InvalidArgumentException $e) {
            return back()
                ->withInput()
                ->withErrors(['b' => $e->getMessage()]);
        }
    }
}