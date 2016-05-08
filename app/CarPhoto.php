<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class CarPhoto extends Model
{
     /**
	 * Enable timestamps
	 */
	public $timestamps = true;
	
   /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'car_photo';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'car_id', 'car_image_url'];
	


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * Get the driver from user list that owns the driver verification.
	 */
	public function Car()
	{
		return $this->belongsTo(Car::class);
	}
}
