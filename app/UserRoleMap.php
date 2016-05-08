<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoleMap extends Model
{
    /**
	 * Disable timestamps
	 */
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_role_map';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'user_id', 'user_role_id'];
	
	/**
	 * Get the user role
	 */
	public function UserRole()
	{
		return $this->belongsTo(UserRole::class);
	}

}
