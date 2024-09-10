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
        Schema::create('leave_information', function (Blueprint $table) {
            $table->id('leave_id');
            $table->foreignId('employee_id_number')->constrained('employees');
            $table->string('staff_name', 150);
            $table->string('division', 50);
            $table->string('department', 50);
            $table->string('job_title', 50);
            $table->string('type_of_leave', 50);
            $table->integer('no_of_leaves_requested');
            $table->integer('total_leaves_perYear');
            $table->integer('total_leaves_taken');
            $table->date('leave_commencement');
            $table->date('date_of_return');
            $table->date('date_requested');
            $table->string('supervisor_approval', 50);
            $table->date('date_of_approval_SR');
            $table->string('HR_approval', 50);
            $table->date('date_of_approval_HR');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_information');
    }
};
