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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airlineid')->references('id')->on('airlines');
            $table->foreignId('planesid')->references('id')->on('planes');
            $table->timestamp('departuredate');
            $table->timestamp('arrivaldate');
            $table->string('departing');
            $table->string('arriving');
            $table->enum('Status', ['pending','landing','departing','arriving','closed'])->default('pending');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
