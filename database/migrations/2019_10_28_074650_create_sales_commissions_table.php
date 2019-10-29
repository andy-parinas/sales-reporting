<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_report_id');
            $table->unsignedBigInteger('tour_commission_id');
            $table->float('amount');
            $table->timestamps();

            $table->foreign('sales_report_id')->references('id')->on('sales_reports')->onDelete('restrict');
            $table->foreign('tour_commission_id')->references('id')->on('tour_commissions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_commissions');
    }
}
