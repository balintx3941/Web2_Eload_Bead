<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Oprendszer;
use Illuminate\Support\Facades\Storage;

class OprendszerSeeder extends Seeder
{
    public function run(): void
    {
        $adatok = file(storage_path('app/oprendszer.txt'));
        array_shift($adatok); // Fejléc eldobása
        
        foreach ($adatok as $sor) {
            $sor = trim($sor);
            if (!$sor) continue;
            
            $mezo = explode("\t", $sor); // Tabulátorral vannak elválasztva
            
            Oprendszer::create([
                'id' => $mezo[0],
                'nev' => $mezo[1],
            ]);
        }
    }
}
