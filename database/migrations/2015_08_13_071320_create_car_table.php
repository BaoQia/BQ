<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('car');
        Schema::create('car', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('seats', 1, 0)->unsigned();
            $table->decimal('doors', 1, 0)->unsigned();
            $table->string('plate_number', 50);
            $table->string('manufacturer', 50);
            $table->string('model', 50);
            $table->decimal('year', 4, 0)->unsigned();
            $table->decimal('booking_price', 10, 0)->unsigned()->default(0);
            $table->smallInteger('total_booking_hour')->unsigned()->default(0);
            $table->decimal('ot_price', 10, 0)->unsigned()->default(0);
            $table->decimal('late_night_charge', 10, 0)->unsigned()->default(0);           
            $table->decimal('insurance_price', 10, 0)->unsigned()->default(0);
            $table->integer('driver_user_id')->unsigned()->unique;
            $table->foreign('driver_user_id')->references('id')->on('user');
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
         Schema::drop('car');  
    }
}
