<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_report_id');
            $table->unsignedBigInteger('deduction_id');
            $table->float('amount');
            $table->timestamps();

            $table->foreign('sales_report_id')->references('id')->on('sales_reports')->onDelete('restrict');
            $table->foreign('deduction_id')->references('id')->on('deductions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_deductions');
    }
}
