<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('oprendszers', function (Blueprint $table) {
        $table->id(); // Ez az 'id'
        $table->string('nev'); // <--- EZ HIÁNYZIK VAGY ROSSZ NEVŰ!
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oprendszers');
    }
};
