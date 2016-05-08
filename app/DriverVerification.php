<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverVerification extends Model
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
  protected $hidden = ['id','created_at','updated_at'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'driver_verification';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'ic_status', 'driver_license_status','driver_user_id'];
	
	/**
	 * Get the driver from user list that owns the driver verification.
	 */
	public function User()
	{
		return $this->belongsTo(User::class);
	}
}
