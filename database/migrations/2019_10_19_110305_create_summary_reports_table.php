<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('report_number');
            $table->integer('adult_count_total');
            $table->integer('children_count_total');
            $table->integer('tc_count');
            $table->float('sales_total');
            $table->float('agent_commissions_total');
            $table->float('gst_total');
            $table->float('total');
            $table->float('return')->default(0);
            $table->float('duvet_deduction')->default(0);
            $table->float('balance');
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
        Schema::dropIfExists('summary_reports');
    }
}
