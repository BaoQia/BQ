<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('car_photo');
        Schema::create('car_photo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned()->unique;
            $table->foreign('car_id')->references('id')->on('car');
            $table->string('car_image_url', 4096);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('car_photo');
    }
}
