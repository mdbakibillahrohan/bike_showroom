<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashReciveDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_recive_details', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('note_input')->nullable();
            $table->integer('return_show')->nullable();
            $table->string('cardname')->nullable();
            $table->integer('cardno')->nullable();
            $table->integer('bkash')->nullable();
            $table->string('bankname')->nullable();
            $table->string('chequeno')->nullable();
            $table->string('date');
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
        Schema::dropIfExists('cash_recive_details');
    }
}
