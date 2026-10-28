<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kapcsolat_uzenets', function (Blueprint $table) {
            $table->id();
            $table->string('nev');
            $table->string('email');
            $table->string('targy');
            $table->text('uzenet');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kapcsolat_uzenets');
    }
};
