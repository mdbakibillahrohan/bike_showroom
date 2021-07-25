<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profitorders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->integer('product_id');
            $table->string('purchase_id');
            $table->integer('showroom_id');
            $table->string('buy_price');
            $table->string('sell_price');
            $table->string('quantity');
            $table->string('total_buy_amount');
            $table->string('total_sell_amount');
            $table->string('selldate');
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
        Schema::dropIfExists('profitorders');
    }
}
