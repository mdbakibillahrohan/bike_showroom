<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no');
            $table->integer('product_id');
            $table->string('product_type');
            $table->string('attribute')->nullable();
            $table->decimal('buy_price', 10, 2);
            $table->decimal('quantity',10, 2);
            $table->decimal('sub_total_buy',10, 2);
            $table->decimal('buy_cost',10, 2)->nullable()->default(0.00);
            $table->decimal('discount',10, 2)->nullable()->default(0.00);
            $table->decimal('actual_buy',10, 2);
            $table->decimal('rest_qty',10, 2);
            $table->decimal('rest_buy_amount',10, 2);
            $table->string('sell_price')->nullable()->default(0.00);
            $table->integer('with_free')->nullable();
            $table->integer('showroom_id');
            $table->integer('supplier_id')->nullable();
            $table->integer('makeby');
            $table->string('purchase_date');
            $table->enum('purchase_type', array('0','1'))->default('1');
            $table->enum('status', array('0','1'))->default('1');
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
        Schema::dropIfExists('purchases');
    }
}
