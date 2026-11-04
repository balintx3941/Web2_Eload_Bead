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
    Schema::create('geps', function (Blueprint $table) {
        $table->id();
        $table->string('gyarto');
        $table->string('tipus');
        $table->float('kijelzo');
        $table->integer('memoria');
        $table->integer('merevlemez');
        $table->string('videovezerlo');
        $table->integer('ar');
        $table->foreignId('processzorid')->constrained('processzors');
        $table->foreignId('oprendszerid')->constrained('oprendszers');
        $table->integer('db');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geps');
    }
};
