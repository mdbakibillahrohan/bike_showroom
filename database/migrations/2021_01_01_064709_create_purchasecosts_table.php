<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasecostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasecosts', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_pay_id')->nullable()->default(0);
            $table->integer('showroom_id');
            $table->string('cost_reson');
            $table->string('cost_amount');
            $table->string('date');
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
        Schema::dropIfExists('purchasecosts');
    }
}
