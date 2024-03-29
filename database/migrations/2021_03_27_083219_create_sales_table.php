<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->double('paid_money');
            $table->double('remain_money');
            $table->double('total_money');

            $table->integer('total_amount');
            $table->integer('received_amount');
            $table->integer('remain_amount');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->index('user_id');
            $table->index('product_id');
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
        Schema::dropIfExists('sales');
    }
}
