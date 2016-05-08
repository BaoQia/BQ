<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeds\UserStatusTable;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 Model::unguard();
		 
		$this->call('UserStatusTableSeeder');
		$this->command->info('User status table seeded!');
		$this->call('UserRoleTableSeeder');
		$this->command->info('User Roles table seeded!');
		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');
    $this->call('CarTableSeeder');
		$this->command->info('Car table seeded!');
	}

}

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	 
	public function run()
	{
		DB::table('user')->delete();

        $userid = DB::table('user')->insertGetId([
            'name' => 'Jolin Tsai',
            'email' => 'admin@bq.com',
            'password' => bcrypt('jolin123'),
        	'user_status_id' => '2',
        ]);
        
        DB::table('user_role_map')->delete();
        DB::table('user_role_map')->insert([
        		'user_id' => $userid,
				'user_role_id' => '2',
        ]);
        
        $userid = DB::table('user')->insertGetId([
            'name' => 'Jolin Tsai2',
            'email' => 'admin2@bq.com',
            'password' => bcrypt('jolin123'),
        	'user_status_id' => '2',
        ]);
        
        DB::table('user_role_map')->insert([
        		'user_id' => $userid,
				'user_role_id' => '2',
        ]);
	}

}


class UserRoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	 
	public function run()
	{
		DB::table('user_role')->delete();
		
		DB::table('user_role')->insert([
				'id' => '1',
				'name' => 'Admin',
				'description' => '',
		]);
		
		DB::table('user_role')->insert([
				'id' => '2',
				'name' => 'Agent',
				'description' => '',
		]);
		
		DB::table('user_role')->insert([
				'id' => '3',
				'name' => 'Traveller',
				'description' => '',
		]);
	}	
}


class CarTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	 
	public function run()
	{
		DB::table('car')->delete();
		
		DB::table('car')->insert([
				'id' => 1,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB111',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1998,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:54',
        'updated_at' => '2015-08-20 03:37:54'
		]);

    DB::table('car')->insert([
				'id' => 2,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB112',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1998,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:55',
        'updated_at' => '2015-08-20 03:37:55'
		]);

    DB::table('car')->insert([
				'id' => 3,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB113',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);

    DB::table('car')->insert([
				'id' => 4,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB114',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 5,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB115',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 6,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB116',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 7,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB117',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 8,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB118',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 9,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB119',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 10,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB120',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    
    DB::table('car')->insert([
				'id' => 11,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB121',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    DB::table('car')->insert([
				'id' => 12,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB122',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 1,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
    
    DB::table('car')->insert([
				'id' => 13,
				'seats' => 4,
				'doors' => 4,
        'plate_number' => 'BBB123',
				'manufacturer' => 'Toyota',
				'model' => 'Corolla',
        'year' => 1999,
				'booking_price' => 300,
				'total_booking_hour' => 8,
        'ot_price' => 5,
				'late_night_charge' => 20,
				'insurance_price' => 10,
				'driver_user_id' => 2,
        'created_at' => '2015-08-20 03:37:56',
        'updated_at' => '2015-08-20 03:37:56'
		]);
	}	
}

