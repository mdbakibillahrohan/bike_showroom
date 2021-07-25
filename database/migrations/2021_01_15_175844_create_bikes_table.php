<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('details')->nullable();
            $table->integer('categorie_id');
            $table->integer('subcategorie_id');
            $table->integer('brand_id');
            $table->integer('user_id');
            $table->integer('showroom_id');
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
        Schema::dropIfExists('bikes');
    }
}
