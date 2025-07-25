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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('doctor_ticket_id')
                ->nullable()
                ->after('doctor_id') // Coloca la columna después de doctor_id
                ->constrained('doctor_tickets')
                ->onDelete('set null');
            $table->index('doctor_ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_ticket_id']);
            $table->dropColumn('doctor_ticket_id');
        });
    }
};
