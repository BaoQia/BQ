<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FBAccess extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fb_access';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'fb_user_id', 'token'];
	
	
	/**
	 * Get the user
	 */
	public function User()
	{
		return $this->belongsTo(User::class);
	}
}
