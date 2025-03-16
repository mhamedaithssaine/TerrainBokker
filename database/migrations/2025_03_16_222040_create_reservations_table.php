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
            $table->unsignedBigInteger('terrain_id'); 
            $table->unsignedBigInteger('sportive_id'); 
            $table->dateTime('date_debut'); 
            $table->dateTime('date_fin'); 
            $table->enum('statut', ['confirmée', 'en_attente', 'annulée'])->default('en_attente');
            $table->foreign('terrain_id')->references('id')->on('terrains')->onDelete('cascade');
            $table->foreign('sportive_id')->references('id')->on('users')->onDelete('cascade');
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
