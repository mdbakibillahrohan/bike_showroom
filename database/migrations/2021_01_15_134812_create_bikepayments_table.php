<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikepayments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_date');
            $table->string('payment_type');
            $table->integer('bikecustomer_id');
            $table->integer('bike_id');
            $table->integer('Pay_amount');
            $table->string('bankdetails')->nullable();
            $table->string('carddetails')->nullable();
            $table->string('mobilebankdetails')->nullable();
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
        Schema::dropIfExists('bikepayments');
    }
}
