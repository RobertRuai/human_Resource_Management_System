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
        Schema::create('leave_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id_number');
            $table->string('staff_name', 150);
            $table->string('division', 50);
            $table->unsignedBigInteger('department_id');
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
            $table->unsignedBigInteger('HR_approval')->nullable();
            $table->date('date_of_approval_HR');
            $table->string('status', 50)->default('Pending');
            $table->string('reason', 250);
            $table->timestamps();

            $table->foreign('employee_id_number')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('HR_approval')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_informations');
    }
};
