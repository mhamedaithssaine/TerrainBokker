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
        Schema::create('terrains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->float('prix');
            $table->unsignedBigInteger('sponsor_id')->nullable(); 
            $table->unsignedBigInteger('categorie_id'); 
            $table->enum('statut', ['disponible', 'indisponible'])->default('disponible');
            $table->string('adresse');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('set null');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terrains');
    }
};
