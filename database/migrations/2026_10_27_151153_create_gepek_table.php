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
        Schema::create('gepek', function (Blueprint $table) {
            $table->id();
            $table->string('gyarto');
            $table->string('tipus');
            $table->string('kijelzo');
            $table->string('memoria');
            $table->string('merevlemez');
            $table->string('videovezerlo');
            $table->decimal('ar', 12, 2);
            $table->unsignedBigInteger('processzorid');
            $table->unsignedBigInteger('oprendszerid');
            $table->integer('db')->default(0);
            $table->timestamps();

            $table->foreign('processzorid')
                ->references('id')
                ->on('processzorok');

            $table->foreign('oprendszerid')
                ->references('id')
                ->on('oprendszerek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gepek');
    }
};
