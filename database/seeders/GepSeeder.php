<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fajl = storage_path('app/data/gep.txt');

        if (! file_exists($fajl)) {
            throw new \RuntimeException(
                'Nem található a fájl: ' . $fajl
            );
        }

        $sorok = file(
            $fajl,
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );

        // Az első sor az oszlopneveket tartalmazza.
        array_shift($sorok);

        foreach ($sorok as $sor) {
            $adatok = array_map(
                'trim',
                explode("\t", $sor)
            );

            if (count($adatok) < 10) {
                continue;
            }

            $gep = [
                'gyarto' => $adatok[0],
                'tipus' => $adatok[1],
                'kijelzo' => $adatok[2],
                'memoria' => $adatok[3],
                'merevlemez' => $adatok[4],
                'videovezerlo' => $adatok[5],
                'ar' => (int) $adatok[6],
                'processzorid' => (int) $adatok[7],
                'oprendszerid' => (int) $adatok[8],
                'db' => (int) $adatok[9],
            ];

            DB::table('gepek')->updateOrInsert(
                $gep,
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
