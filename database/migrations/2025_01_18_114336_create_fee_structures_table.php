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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained()->onDelete('cascade'); // Assuming you have a classes table
            $table->foreignId('caste_id')->constrained()->onDelete('cascade'); // Assuming you have a castes table
            $table->string('fee_type');
            $table->decimal('monthly_tution_fee', 50, 2); // Adjusted for monetary values
            $table->decimal('admission_fee', 50, 2); 
            $table->decimal('registration_fee', 50, 2);
            $table->decimal('art_material', 50, 2);
            $table->decimal('transport', 50, 2);
            $table->decimal('books', 50, 2);
            $table->decimal('uniform', 50, 2);
            $table->decimal('others', 50, 2);
            $table->decimal('total_amount', 50, 2); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
