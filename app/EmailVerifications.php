<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerifications extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'email_verification';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'token'];
	
	/**
	 * Disable timestamps
	 */
	public $timestamps = false;

	/**
	 * Get the user that owns the email verification.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
