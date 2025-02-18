<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('cola', 10, 2)->nullable();
            $table->decimal('rep', 10, 2)->nullable();
            $table->decimal('resp', 10, 2)->nullable();
            $table->decimal('hse', 10, 2)->nullable();
            $table->decimal('ag', 10, 2)->nullable();
            $table->decimal('job_spec', 10, 2)->nullable();
            $table->decimal('gross_salary', 10, 2);
            $table->decimal('pen_contr', 10, 2)->nullable();
            $table->decimal('tax_exempt', 10, 2)->nullable();
            $table->decimal('taxable_amount', 10, 2);
            $table->decimal('pit', 10, 2);
            $table->decimal('sal_adv', 10, 2)->nullable();
            $table->decimal('other_ded', 10, 2)->nullable();
            $table->decimal('net_pay', 10, 2);
            $table->string('account_number');
            $table->string('bank');
            $table->timestamps();

             // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
