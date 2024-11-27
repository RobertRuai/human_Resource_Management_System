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
        Schema::create('training_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id'); // Foreign key for trainings
            $table->unsignedBigInteger('employee_id'); // Foreign key for employees
            $table->timestamps(); // Optional: Created at and updated at fields

            // Foreign key constraints
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            // Ensure unique combinations of training_id and employee_id
            $table->unique(['training_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_employee');
    }
};
