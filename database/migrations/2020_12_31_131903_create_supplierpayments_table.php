<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplierpayments', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('invoice_no');
            $table->string('payment_date');
            $table->string('pay_amount');
            $table->string('payment_details')->nullable();
            $table->string('money_receipt')->nullable();
            $table->integer('make_by');
            $table->integer('status')->nullable();
            $table->integer('showroom_id');
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
        Schema::dropIfExists('supplierpayments');
    }
}
