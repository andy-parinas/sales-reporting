<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('report_number');
            $table->string('grp_code');
            $table->integer('adult_count');
            $table->integer('children_count');
            $table->unsignedBigInteger('tour_agent_id');
            $table->unsignedBigInteger('tour_guide_id');
            $table->string('tc_name');
            $table->float('total_sales');
            $table->float('total_agent_sales');
            $table->float('total_commission');
            $table->float('gst');
            $table->float('grand_total_commission');
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
        Schema::dropIfExists('sales_reports');
    }
}
