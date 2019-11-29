<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryReportItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_report_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('summary_report_id');
            $table->unsignedBigInteger('sales_report_id');
            $table->timestamps();

            $table->foreign('summary_report_id')->references('id')->on('summary_reports')->onDelete('cascade');
            $table->foreign('sales_report_id')->references('id')->on('sales_reports')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_report_items');
    }
}
