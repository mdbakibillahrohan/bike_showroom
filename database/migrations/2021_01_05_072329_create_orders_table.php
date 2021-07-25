<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("invoice_no");
            $table->integer("customer_id");
            $table->integer("showroom_id");
            $table->integer("product_id");
            $table->string("product_details")->nullable();
            $table->integer("category_id");
            $table->integer("sub_category")->nullable()->default(0);
            $table->integer("brand_id")->nullable()->default(0);
            $table->string("product_code")->nullable()->default(0);
            $table->string("sellprice");
            $table->decimal("quantity",10, 2);
            $table->decimal("total_sellprice",10, 2);
            $table->decimal("sell_discount",10, 2)->default(0.00)->nullable();
            $table->decimal("sell_cost",10, 2)->default(0.00)->nullable();
            $table->decimal("lastsell_amount",10, 2)->default(0.00)->nullable();
            $table->string("vat")->default(0)->nullable();
            $table->string("attribute")->nullable();
            $table->string("return_cash")->default(0)->nullable();
            $table->integer("return_invoice")->nullable();
            $table->string("selldate");
            $table->integer("user_id");
            $table->integer("warranty")->default(0)->nullable();
            $table->integer("status")->default(1);
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
        Schema::dropIfExists('orders');
    }
}
