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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User relation
            
            $table->string('student_name', 100);
            $table->string('class', 50);
            $table->string('email')->unique();

            $table->date('dob'); // Date of birth
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('religion', 50)->nullable();
            $table->string('community', 50)->nullable();
            $table->string('nationality', 50)->default('Indian');
            $table->boolean('orphan_student_status')->default(false); // Boolean for orphan status
            $table->string('birth_id', 50)->unique()->nullable();
            $table->string('aadharno', 12)->unique()->nullable(); // Aadhaar number
            $table->string('identification_mark', 255)->nullable();
            $table->string('previous_school', 100)->nullable();
            $table->unsignedInteger('total_siblings')->default(0); // Number of siblings
            $table->string('blood_grp', 5)->nullable(); // Blood group
            $table->boolean('disease_status')->default(false); // Boolean for diseases
            $table->date('doa'); // Date of admission
            $table->decimal('discount_fee', 8, 2)->nullable(); // Discounted fee
            $table->string('profile_picture', 255)->nullable(); // Profile picture path
            $table->text('permanent_address');
            $table->text('current_address')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('father_aadhaar_no', 12)->unique()->nullable();
            $table->string('father_occupation', 50)->nullable();
            $table->string('father_mobile_no', 15)->nullable();
            $table->boolean('father_mobile_status_wp')->default(false); // Boolean for WhatsApp status
            $table->decimal('father_income', 10, 2)->nullable(); // Income
            $table->string('mother_name', 100)->nullable();
            $table->string('mother_aadhaar_no', 12)->unique()->nullable();
            $table->string('mother_occupation', 50)->nullable();
            $table->string('mother_mobile_no', 15)->nullable();
            $table->boolean('mother_mobile_status_wp')->default(false); // Boolean for WhatsApp status
            $table->decimal('mother_income', 10, 2)->nullable(); // Income
            $table->boolean('active_status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
