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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('type_of_leave');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_days')->default(0);
            $table->string('status')->default('pending'); // pending, supervisor_review, hr_review, approved, rejected
            $table->text('employee_remarks')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->text('supervisor_remarks')->nullable();
            $table->date('supervisor_action_date')->nullable();
            $table->unsignedBigInteger('hr_manager_id')->nullable();
            $table->text('hr_remarks')->nullable();
            $table->date('hr_action_date')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('hr_manager_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
