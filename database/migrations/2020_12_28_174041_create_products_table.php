<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_deatils')->nullable();
            $table->integer('categorie_id');
            $table->integer('subcategorie_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('sell_type');
            $table->string('attrebute')->nullable();
            $table->string('warranty')->nullable();
            $table->string('big_unit_relation')->nullable();
            $table->string('small_unit_relation')->nullable();
            $table->integer('showroom_id');
            $table->enum('status', array('0','1'))->default('0');
            $table->integer('makeby');
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
        Schema::dropIfExists('products');
    }
}
