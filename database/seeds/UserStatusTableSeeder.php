<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert([
				'id' => '1',
				'name' => 'Registered',
				'description' => 'Sign Up but not yet verify email.',
		]);
        
        DB::table('user_status')->insert([
        		'id' => '2',
        		'name' => 'Active',
        		'description' => 'Account is active.',
        ]);
    }
}
