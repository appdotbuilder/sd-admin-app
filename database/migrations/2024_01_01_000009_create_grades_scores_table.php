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
        Schema::create('grades_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->enum('assessment_type', ['quiz', 'assignment', 'midterm', 'final', 'project'])->comment('Type of assessment');
            $table->decimal('score', 5, 2)->comment('Score value (0-100)');
            $table->decimal('max_score', 5, 2)->default(100)->comment('Maximum possible score');
            $table->string('assessment_name')->comment('Name of the assessment');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->date('assessment_date')->comment('Date of assessment');
            $table->string('academic_year')->comment('Academic year');
            $table->enum('semester', ['1', '2'])->comment('Semester');
            $table->timestamps();
            
            $table->index(['student_id', 'subject_id', 'academic_year']);
            $table->index(['class_id', 'subject_id', 'assessment_type']);
            $table->index(['teacher_id', 'academic_year']);
            $table->index('assessment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades_scores');
    }
};