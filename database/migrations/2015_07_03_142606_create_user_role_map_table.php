<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('user_role_map');
        	 
        Schema::create('user_role_map', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->smallInteger('user_role_id');
        	
        	$table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        	$table->foreign('user_role_id')->references('id')->on('user_role')->onDelete('cascade');
       	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_role_map');
    }
}
