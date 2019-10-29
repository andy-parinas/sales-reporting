<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tour_agent_id');
            $table->unsignedBigInteger('tour_type_id');
            $table->unsignedBigInteger('commission_type_id');
            $table->unsignedBigInteger('commission_id');
            $table->float('amount');
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
        Schema::dropIfExists('tour_commissions');
    }
}
