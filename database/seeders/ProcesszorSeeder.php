<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcesszorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fajl = storage_path('app/data/processzor.txt');

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
            $adatok = explode("\t", $sor);

            if (count($adatok) < 3) {
                continue;
            }

            DB::table('processzorok')->updateOrInsert(
                ['id' => (int) trim($adatok[0])],
                [
                    'gyarto' => trim($adatok[1]),
                    'tipus' => trim($adatok[2]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
         }

    }
}
