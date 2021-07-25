<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecivecashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recivecashes', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->integer('customer_id');
            $table->integer('showroom_id');
            $table->string('received');
            $table->string('received_date');
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
        Schema::dropIfExists('recivecashes');
    }
}
