<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('showroom_name');
            $table->string('address');
            $table->string('mobile');
            $table->longText('showroom_details')->nullable();
            $table->string('expired_date');
            $table->string('showroom_image')->nullable();
            $table->enum('status', array('0','1'))->default('1');
            $table->string('slag');
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
        Schema::dropIfExists('showrooms');
    }
}
