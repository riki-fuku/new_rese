<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('shop_area_id');
            $table->unsignedBigInteger('shop_genre_id');
            $table->text('description');
            $table->integer('capacity');
            $table->timestamps();

            $table->foreign('shop_area_id')->references('id')->on('shop_areas');
            $table->foreign('shop_genre_id')->references('id')->on('shop_genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
