<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFBAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::dropIfExists('fb_access');
    	
        Schema::create('fb_access', function (Blueprint $table) {
        	$table->increments('id');
            $table->integer('user_id')->unsigned()->unique;
            $table->bigInteger('fb_user_id')->unsigned()->unique;
            $table->string('token', 255);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fb_access');
    }
}
