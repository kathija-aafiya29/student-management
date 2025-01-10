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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
    
            // Foreign key for users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            // Employee details
            $table->string('employee_name', 255);
            $table->string('employee_role', 100);
            $table->date('dob');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email')->unique();
            $table->string('blood_grp', 3);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('emp_relative_name', 255);
            $table->string('religion', 100);
            $table->string('community', 100);
            $table->string('nationality', 100);
            $table->string('education', 255);
            $table->integer('experience')->comment('Years of experience');
            $table->date('doj');
            $table->decimal('monthly_salary', 10, 2);
            $table->string('aadharno', 12)->unique();
            $table->string('mobileno', 15)->unique();
            $table->string('alt_mobileno', 15)->nullable();
            $table->boolean('mobileno_wp_status')->default(false);
            $table->boolean('alt_mobileno_wp_status')->default(false);
            $table->text('permanent_address');
            $table->text('current_address')->nullable();
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
