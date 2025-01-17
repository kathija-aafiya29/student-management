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
            $table->id(); // Auto-increment primary key
            $table->string('class_name'); // Class name
            $table->string('class_code')->unique(); // Unique class code
            $table->string('section')->nullable(); // Section (nullable)
            $table->unsignedInteger('total_students')->default(0); // Total students
            $table->unsignedInteger('no_of_boys')->default(0); // Number of boys
            $table->unsignedInteger('no_of_girls')->default(0); // Number of girls
            $table->softDeletes(); // Deleted_at column for soft deleted
            $table->timestamps(); // Created_at and updated_at columns

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
