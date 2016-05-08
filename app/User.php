<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'phone_number', 'user_status_id', 'profile_image_url'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Get the user role map
	 */
	public function UserRoleMap()
	{
		return $this->hasMany(UserRoleMap::class);
	}
	
	/**
	 * Get the user status
	 */
	public function UserStatus()
	{
		return $this->belongsTo(UserStatus::class);
	}
	
	/**
	 * Get the fb access
	 */
	public function FBAccess()
	{
		return $this->hasOne(FBAccess::class);
	}
  
   /**
	 * Get the driver verification
	 */
	public function DriverVerication()
	{
		return $this->hasOne(DriverVerification::class);
	}
  
  	/**
	 * Get the cars
	 */
	public function car()
	{
		return $this->hasMany(Car::class);
	}
	
}
