<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        // 1. Neptun-kódos adminisztrátor fiók
        User::updateOrCreate(
            ['email' => 'azq13j@hallgato.nje.hu'],
            [
                'name' => 'Horváth Gréta',
                'password' => Hash::make('Admin123!'),
                'role' => 1,
            ]
        );

        // 2. Alapértelmezett admin fiók
        User::updateOrCreate(
            ['email' => 'admin@laptopdb.hu'],
            [
                'name' => 'Adminisztrátor',
                'password' => Hash::make('admin123'),
                'role' => 1,
            ]
        );

        // 3. Regisztrált tesztfelhasználó
        User::updateOrCreate(
            ['email' => 'user@laptopdb.hu'],
            [
                'name' => 'Teszt Elek',
                'password' => Hash::make('user123'),
                'role' => 2,
            ]
        );

        // 4. Laptop adatok betöltése a szöveges fájlokból
        if (class_exists(ProcesszorSeeder::class)) {
            $this->call(ProcesszorSeeder::class);
        }
        if (class_exists(OprendszerSeeder::class)) {
            $this->call(OprendszerSeeder::class);
        }
        if (class_exists(GepSeeder::class)) {
            $this->call(GepSeeder::class);
        }
        if (class_exists(PersonSeeder::class)) {
            $this->call(PersonSeeder::class);
        }

        Model::reguard();
    }
}