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
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('department_id');
            $table->string('first_name', 50);
            $table->string('middle_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 100)->unique();
            $table->string('city', 50);
            $table->string('address', 100);
            $table->string('postal_code', 10);
            $table->string('qualification', 50);
            $table->text('current_experience');
            $table->string('job_title', 50);
            $table->string('grade', 100);
            $table->date('date_of_employment');
            $table->string('type_of_employment', 20);
            $table->string('division', 50);
            $table->string('location', 50);
            $table->string('gender', 10);
            $table->string('marital_status', 20);
            $table->string('next_of_kin', 100);
            #$table->decimal('salary', 10, 2);           
            #$table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
