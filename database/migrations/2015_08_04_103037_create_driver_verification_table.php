<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('driver_verification');
    	
        Schema::create('driver_verification', function (Blueprint $table) {
        	  $table->increments('id');
            //N=No verification status
            //A=Awaiting verification
            //C=Confirmed verification
            //F=Fail verification
            $table->string('ic_status',1)->default('N');
            $table->string('driver_license_status',1)->default('N');
            $table->integer('driver_user_id')->unsigned()->unique;
            $table->timestamps();
            
            $table->foreign('driver_user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('driver_verification');
    }
}
