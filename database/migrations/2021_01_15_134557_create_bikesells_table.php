<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikesells', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('date');
            $table->integer('bikecustomer_id');
            $table->integer('bike_id');
            $table->string('engine_no');
            $table->string('ChassisNo');
            $table->string('paymentway');
            $table->string('bikedetails')->nullable();
            $table->string('bikesell_type');
            $table->integer('sell_price');
            $table->integer('quantity')->default(1);
            $table->integer('discount')->default(0);
            $table->integer('last_total_amount');
            $table->integer('cashpayment');
            $table->string('interest')->nullable();
            $table->string('last_due_amount');
            $table->string('onetime_payment_date')->nullable();
            $table->string('installmentno')->nullable();
            $table->integer('installmentamount')->nullable();
            $table->string('installment_start_date')->nullable();
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
        Schema::dropIfExists('bikesells');
    }
}
