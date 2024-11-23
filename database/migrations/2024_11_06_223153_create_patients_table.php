<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->enum('identification_type', ['DNI', 'PPT']);
            $table->string('identification_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->date('birth_date');
            $table->string('first_phone');
            $table->string('second_phone')->nullable();
            $table->enum('gender', ['M', 'F', 'NONE'])->default('NONE');
            $table->enum('visit_condition', ['urgent', 'program', 'inactive'])->default('inactive')->nullable();
            $table->text('message')->nullable();
            $table->text('spiritual_diagnosis')->nullable();
            $table->boolean('medical_examination')->nullable();
            $table->boolean('spiritual_support')->nullable();
            $table->boolean('permission_to_call')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
