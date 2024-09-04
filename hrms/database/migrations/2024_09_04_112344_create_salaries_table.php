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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id('salary_id');
            $table->foreignId('employee_id_number')->constrained('employees');
            $table->decimal('monthly_basic_salary', 10, 2);
            $table->string('currency');
            $table->decimal('allowances', 10, 2);
            $table->decimal('gross_salary', 10, 2);
            $table->decimal('monthly_taxes', 10, 2);
            $table->decimal('monthly_deductions', 10, 2);
            $table->decimal('monthly_insurance', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->date('salary_startDate');
            $table->date('salary_endDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
