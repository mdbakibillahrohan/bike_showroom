<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnorders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('return_invoice');
            $table->integer('sell_invoice');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('showroom_id');
            $table->string('sellprice');
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('deducted')->nullable();
            $table->string('return_cash')->nullable();
            $table->string('return_status');
            $table->string('date');
            $table->string('user_id');
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
        Schema::dropIfExists('returnorders');
    }
}
