<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OprendszerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $fajl = storage_path('app/data/oprendszer.txt');

        if (! file_exists($fajl)) {
            throw new \RuntimeException(
                'Nem található a fájl: ' . $fajl
            );
        }

        $sorok = file($fajl, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Az első sor az oszlopneveket tartalmazza.
        array_shift($sorok);

        foreach ($sorok as $sor) {
            $adatok = explode("\t", $sor);

            if (count($adatok) < 2) {
                continue;
            }

            DB::table('oprendszerek')->updateOrInsert(
                ['id' => (int) trim($adatok[0])],
                [
                    'nev' => trim($adatok[1]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
