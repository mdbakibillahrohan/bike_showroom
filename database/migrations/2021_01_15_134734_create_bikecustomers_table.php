<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikecustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikecustomers', function (Blueprint $table) {
            $table->id();
            $table->integer('bikesell_id');
            $table->string('customer_name');
            $table->string('guardian_name');
            $table->string('address');
            $table->string('mobile');
            $table->string('guarantorname')->nullable();
            $table->string('guarantor_address')->nullable();
            $table->string('guarantor_mobile')->nullable();
            $table->string('customer_image')->nullable();
            $table->string('national_id')->nullable();
            $table->string('electric_bill')->nullable();
            $table->string('other_image')->nullable();
            $table->string('payment_type');
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
        Schema::dropIfExists('bikecustomers');
    }
}
