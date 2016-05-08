<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::dropIfExists('user_role');
    	
        Schema::create('user_role', function (Blueprint $table) {
            $table->smallInteger('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            
            $table->primary('id');
        });
        
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::drop('user_role');
    }
}
