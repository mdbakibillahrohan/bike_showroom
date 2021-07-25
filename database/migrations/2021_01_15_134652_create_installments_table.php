<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_date');
            $table->integer('bikecustomer_id');
            $table->integer('bike_id');
            $table->integer('installment_no');
            $table->string('installment_amount');
            $table->string('install_paydate')->nullable();
            $table->integer('pay_amount')->default(0);
            $table->string('interest')->default(0);
            $table->string('blanch')->default(0);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('installments');
    }
}
