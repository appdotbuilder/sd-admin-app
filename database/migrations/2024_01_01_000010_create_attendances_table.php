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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('set null');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->date('attendance_date')->comment('Date of attendance');
            $table->enum('status', ['present', 'absent', 'late', 'sick', 'excused'])->comment('Attendance status');
            $table->time('check_in_time')->nullable()->comment('Time student arrived');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->string('academic_year')->comment('Academic year');
            $table->timestamps();
            
            $table->unique(['student_id', 'class_id', 'attendance_date', 'subject_id']);
            $table->index(['class_id', 'attendance_date']);
            $table->index(['student_id', 'attendance_date']);
            $table->index(['teacher_id', 'attendance_date']);
            $table->index(['academic_year', 'attendance_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};