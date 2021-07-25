<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('bikecustomer_id');
            $table->integer('bike_id');
            $table->string('registrationtype');
            $table->integer('vatamount');
            $table->integer('registrationamount');
            $table->integer('total_amount')->default(0);
            $table->string('payment')->default(0);
            $table->string('due_amount')->default(0);
            $table->string('delivery_date')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('registrations');
    }
}
