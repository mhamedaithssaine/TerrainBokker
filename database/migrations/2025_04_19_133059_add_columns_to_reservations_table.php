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
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('set null')->after('sportive_id');
            $table->string('client_name')->nullable()->after('client_id');
            $table->decimal('payment_advance', 8, 2)->default(0)->after('date_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn(['client_id', 'client_name', 'payment_advance']);
        });
    }
};
