<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::dropIfExists('user_status');
    	
        Schema::create('user_status', function (Blueprint $table) {
            $table->smallInteger('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            
            $table->primary('id');
        });
        
        Schema::table('user', function (Blueprint $table) {
        	$table->smallInteger('user_status_id');
        	$table->foreign('user_status_id')->references('id')->on('user_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('user', function (Blueprint $table) {
    		$table->dropForeign('user_user_status_id_foreign');
    		$table->dropColumn('user_status_id');
    	});
    	
        Schema::drop('user_status');
    }
}
