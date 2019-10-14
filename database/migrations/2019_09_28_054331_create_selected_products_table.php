<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sales_report_id');
            $table->float('price');
            $table->float('cost');
            $table->integer('quantity');
            $table->float('total');
            $table->timestamps();

            $table->foreign('sales_report_id')->references('id')->on('sales_reports')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selected_products');
    }
}
