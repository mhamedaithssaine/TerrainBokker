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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terrain_id')->constrained('terrains')->onDelete('cascade');
            $table->foreignId('sportive_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->string('statut')->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
