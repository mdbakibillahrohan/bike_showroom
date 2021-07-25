<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikepurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikepurchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('date');
            $table->integer('invoice');
            $table->integer('bike_id');
            $table->integer('quantity');
            $table->integer('rest_qty');
            $table->string('buy_price');
            $table->string('commission')->default(0);
            $table->string('sell_price');
            $table->string('discount_price')->default(0);
            $table->string('offer')->nullable();
            $table->string('gift_product')->nullable();
            $table->integer('showroom_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('bikepurchases');
    }
}
