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
            $table->string('grp_code')->nullable(true);
            $table->integer('adult_count');
            $table->integer('children_count');
            $table->unsignedBigInteger('tour_agent_id');
            $table->unsignedBigInteger('tour_guide_id');
            $table->unsignedBigInteger('tour_type_id');
            $table->string('tc_name')->nullable(true);
            $table->date('tour_date');
            $table->float('total_sales');
            $table->float('total_agent_sales');
            $table->float('total_commissions');
            $table->float('total_deductions');
            $table->float('gst');
            $table->float('grand_total_commission');
            $table->timestamps();

            $table->foreign('tour_agent_id')->references('id')->on('tour_agents')->onDelete('restrict');
            $table->foreign('tour_guide_id')->references('id')->on('tour_guides')->onDelete('restrict');
            $table->foreign('tour_type_id')->references('id')->on('tour_types')->onDelete('restrict');
            
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
