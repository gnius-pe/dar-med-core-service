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
        Schema::create('doctor_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->date('available_date');
            $table->integer('total_tickets')->default(0); // Cupos totales para esa fecha
            $table->integer('used_tickets')->default(0); // Cupos ya utilizados
            $table->integer('available_tickets')->virtualAs('total_tickets - used_tickets'); // Cupos disponibles (columna virtual)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Índices para optimizar consultas
            $table->index(['doctor_id', 'available_date']);
            $table->index(['available_date', 'is_active']);

            // Constraint: un doctor no puede tener tickets duplicados para la misma fecha
            $table->unique(['doctor_id', 'available_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_tickets');
    }
};
