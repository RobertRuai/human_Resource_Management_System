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
            $table->id('employee_id');
            $table->string('employee_id_number');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->string('qualification');
            $table->string('current_experience');
            $table->string('job_title');
            $table->string('grade');
            $table->date('date_of_employment');
            $table->string('type_of_employment');
            $table->string('division');
            $table->string('department');
            $table->string('location');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('next_of_kin');
            #$table->foreignId('department_id')->constrained('departments');  
            #$table->decimal('salary', 10, 2);           
            #$table->string('photo')->nullable();
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
