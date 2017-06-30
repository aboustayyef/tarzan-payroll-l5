<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tarzan_id',5)->unique();
            $table->unsignedSmallInteger('tema_sorting_id');
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->date('date_joined')->nullable();
            $table->string('location');
            $table->string('designation');
            $table->decimal('basic_pay',8,2);
            $table->unsignedTinyInteger('days_absent')->default(0);
            $table->decimal('element_car',8,2)->default(0.00);
            $table->decimal('element_rent',8,2)->default(0.00);
            $table->decimal('element_other',8,2)->default(0.00);
            $table->boolean('union')->default(1);
            $table->boolean('wife')->default(1);
            $table->unsignedTinyInteger('children')->default(2);
            $table->boolean('contributes_to_ssf')->default(1);
            $table->boolean('disabled')->default(0);
            $table->boolean('soap')->default(0);
            $table->string('mode_of_payment')->default('cheque');
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('residence')->nullable();
            $table->string('house_number')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('advance_amount',8,2)->default(0.00);
            $table->decimal('other_additions', 8,2)->default(0.00);
            $table->string('other_additions_description')->nullable();
            $table->decimal('other_deductions', 8,2)->default(0.00);
            $table->string('other_deductions_description')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
