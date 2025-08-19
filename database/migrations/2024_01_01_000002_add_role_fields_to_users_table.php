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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->string('phone')->nullable()->comment('Phone number');
            $table->text('address')->nullable()->comment('Address');
            $table->date('birth_date')->nullable()->comment('Date of birth');
            $table->enum('gender', ['male', 'female'])->nullable()->comment('Gender');
            $table->string('employee_id')->nullable()->unique()->comment('Employee ID for teachers');
            $table->string('student_id')->nullable()->unique()->comment('Student ID');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('User status');
            
            $table->index(['role_id', 'status']);
            $table->index('employee_id');
            $table->index('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id', 'phone', 'address', 'birth_date', 'gender', 
                'employee_id', 'student_id', 'status'
            ]);
        });
    }
};