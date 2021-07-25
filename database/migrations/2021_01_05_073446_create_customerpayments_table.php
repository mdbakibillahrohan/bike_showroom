<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerpayments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->integer('customer_id');
            $table->integer('showroom_id');
            $table->string('pay_amount');
            $table->string('payment_way')->nullable();
            $table->string('money_receipt')->nullable();
            $table->string('payment_date');
            $table->integer('make_by');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('customerpayments');
    }
}
