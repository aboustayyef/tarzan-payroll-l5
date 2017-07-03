<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('period_id');
            $table->string('location');
            $table->string('designation');
            $table->decimal('basic_pay',8,2)->nullable();
            $table->decimal('element_car',8,2)->nullable();
            $table->decimal('element_rent',8,2)->nullable();
            $table->decimal('element_other',8,2)->nullable();
            $table->boolean('union');
            $table->boolean('wife');
            $table->unsignedTinyInteger('children');
            $table->boolean('contributes_to_ssf');
            $table->boolean('disabled');
            $table->boolean('soap');
            $table->string('mode_of_payment');
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('advance_amount',8,2)->nullable();
            $table->unsignedTinyInteger('days_absent');
            $table->boolean('age_above_55');
            $table->decimal('ssf_contribution_employee',8,2)->nullable();
            $table->decimal('ssf_contribution_employer',8,2)->nullable();
            $table->decimal('elements',8,2)->nullable();
            $table->decimal('total_emoluments',8,2)->nullable();
            $table->decimal('total_ssf_contributions',8,2)->nullable();
            $table->decimal('children_marriage_relief',8,2)->nullable();
            $table->decimal('disability_relief',8,2)->nullable();
            $table->decimal('net_taxable',8,2)->nullable();
            $table->decimal('union_dues',8,2)->nullable();
            $table->decimal('absence_deduction',8,2)->nullable();
            $table->decimal('ff_levy',8,2)->nullable();
            $table->decimal('other_additions',8,2)->nullable();
            $table->decimal('other_additions_notes',8,2)->nullable();
            $table->decimal('other_deductions',8,2);
            $table->decimal('other_deductions_notes',8,2)->nullable();
            $table->decimal('take_home_amount',8,2)->nullable();
            $table->decimal('tax_payable',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
