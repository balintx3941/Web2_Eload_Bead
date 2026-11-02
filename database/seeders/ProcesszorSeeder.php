<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Processzor;

class ProcesszorSeeder extends Seeder
{
    public function run(): void
    {
        $adatok = file(storage_path('app/processzor.txt'));
        array_shift($adatok); 
        
        foreach ($adatok as $sor) {
            $sor = trim($sor);
            if (!$sor) continue;
            
            $mezo = explode("\t", $sor);
            
            Processzor::create([
                'id' => $mezo[0],
                'gyarto' => $mezo[1],
                'tipus' => $mezo[2],
            ]);
        }
    }
}