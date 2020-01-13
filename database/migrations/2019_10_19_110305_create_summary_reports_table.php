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
            $table->string('title');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('report_number');
            $table->integer('adult_count_total');
            $table->integer('children_count_total');
            $table->integer('tc_count');
            $table->float('sales_total');
            $table->unsignedBigInteger('commission_id');
            $table->float('commission');
            $table->unsignedBigInteger('reportable_id');
            $table->string('reportable_type');
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
