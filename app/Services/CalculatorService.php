<?php

namespace App\Services;

use InvalidArgumentException;

class CalculatorService
{
    public function calculate(float $a, float $b, string $operation): float
    {
        return match ($operation) {
            '+', 'add' => $a + $b,
            '-', 'sub' => $a - $b,
            '*', 'mul' => $a * $b,
            '/', 'div' => $b != 0.0 ? $a / $b : throw new InvalidArgumentException('Nullával való osztás nem értelmezett.'),
            default => throw new InvalidArgumentException('Ismeretlen művelet.'),
        };
    }
}