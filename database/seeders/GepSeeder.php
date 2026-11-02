<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gep;

class GepSeeder extends Seeder
{
    public function run(): void
    {
        $adatok = file(storage_path('app/gep.txt'));
        array_shift($adatok); 
        
        foreach ($adatok as $sor) {
            $sor = trim($sor);
            if (!$sor) continue;
            
            $mezo = explode("\t", $sor);
            
            Gep::create([
                'gyarto' => $mezo[0],
                'tipus' => $mezo[1],
                'kijelzo' => (float) str_replace(',', '.', $mezo[2]), // Vesszőből pont
                'memoria' => (int) $mezo[3],
                'merevlemez' => (int) $mezo[4],
                'videovezerlo' => $mezo[5],
                'ar' => (int) $mezo[6],
                'processzorid' => (int) $mezo[7],
                'oprendszerid' => (int) $mezo[8],
                'db' => (int) $mezo[9],
            ]);
        }
    }
}