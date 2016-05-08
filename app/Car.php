<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Car extends Model
{
     /**
	 * Enable timestamps
	 */
	public $timestamps = true;
	
   /**
	 *  hide from json representation
	 *
	 * @var string
	 */
    protected $hidden = ['updated_at', 'driver_user_id'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'car';
	


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'seats', 'doors', 'plate_number', 'manufacturer', 'model', 'year','booking_price','total_booking_hour','ot_price','late_night_charge','insurance_price','updated_at'];
	
	/**
	 * Get the driver from user list that owns the driver verification.
	 */
	public function User()
	{
		return $this->belongsTo(User::class);
	}
}
