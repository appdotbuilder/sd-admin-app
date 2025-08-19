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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Class name (e.g., 1A, 2B)');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('capacity')->default(30)->comment('Maximum number of students');
            $table->string('room')->nullable()->comment('Classroom location');
            $table->string('academic_year')->comment('Academic year (e.g., 2024/2025)');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Class status');
            $table->timestamps();
            
            $table->index(['grade_id', 'academic_year']);
            $table->index('teacher_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};