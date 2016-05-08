<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
Route::get ( '/', function () {
	return view ( 'welcome' );
} );

Route::group ( [ 
		'prefix' => LaravelLocalization::setLocale (),
		'middleware' => [ 
				'localeSessionRedirect',
				'localizationRedirect' 
		] 
], function () {
	/**
	 * ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP *
	 */
	Route::get ( '/', function () {
		return View::make ( 'welcome' );
	} );
	
	// Authentication routes...
	Route::get ( 'auth/login', 'Auth\AuthController@getLogin' );
	Route::post ( 'auth/login', 'Auth\AuthController@postLogin' );
	
	Route::get ( 'auth/logout', 'Auth\AuthController@getLogout' );
	Route::get ( 'auth/waiting-activation', 'Auth\AuthController@getWaitingActivation' );
	
	// FB Authentication routes...
	Route::get ( 'auth/fblogin', 'Auth\AuthController@redirectToFBLogin' );
	Route::get ( 'auth/fbcallback', 'Auth\AuthController@handleFBLoginCallback' );
	
	// Registration routes...
	Route::get ( 'auth/register', 'Auth\AuthController@getRegister' );
	Route::post ( 'auth/register', 'Auth\AuthController@postRegister' );
	
	// Email Verification routes...
	Route::post ( 'auth/verify', 'Auth\AuthController@postVerify' );
	Route::get ( 'auth/verify/{id}/{token}', 'Auth\AuthController@getVerify' );
	
	// Forgot Password routes...
	Route::get ( 'password/email', 'Auth\PasswordController@getEmail' );
	Route::post ( 'password/email', 'Auth\PasswordController@postEmail' );
	Route::get ( 'password/reset/{token}', 'Auth\PasswordController@getReset' );
	Route::post ( 'password/reset', 'Auth\PasswordController@postReset' );
	
	// Profile
	Route::get ( 'profile', 'ProfileController@index' );
	Route::post ( 'profile/update', 'ProfileController@update' );
	
	Route::get ( 'profile/avatar', 'ProfileController@getProfileImage' );
	Route::get ( 'profile/sm-avatar', 'ProfileController@getSmProfileImage' );
	
	Route::get ( 'updateavatar', 'ProfileController@getAvatar' );
	Route::post ( 'updateavatar', 'ProfileController@postAvatar' );
	
	Route::get ( 'role', 'ProfileController@getRole' );
	
	// Profile - change password
	Route::get ( 'changepassword', 'ChangePasswordController@index' );
	Route::post ( 'changepassword/update', 'ChangePasswordController@update' );
	
	// Profile - verification
	Route::get ( 'verification', 'VerificationController@index' );
	Route::get ( 'verification/status', 'VerificationController@getStatus' );
	Route::post ( 'verification/upload/{type}', 'VerificationController@upload' );
	
	// Profile - add car
	Route::get ( 'mycars', 'CarController@index' );
	Route::get ( 'createcar', 'CarController@getCreateCarPage' );
	Route::get ( 'editcar/{id}', 'CarController@getEditCarPage' );
	Route::get ( 'checkCarPlate', 'CarController@checkDuplicateCarPlate' );
	Route::get ( 'getCars', array (
			'as' => 'getCars',
			'uses' => 'CarController@getDatatable' 
	) );
	Route::get ( 'editcar/save/{id}', 'CarController@saveEditCarPage' );
	Route::post ( 'carphotos/{id}', 'CarController@uploadCarPhotos' );
	Route::get ( 'carphotos/{id}', 'CarController@getPhoto' );
	Route::get ( 'noOfCarphoto/{id}', 'CarController@getNoOfCarPhoto' );
	Route::post ( 'removeCarPhoto/{filename}', 'CarController@postRemoveCarPhoto' );
	
	// car api
	Route::post ( 'createcar', 'CarController@postCreateCar' );
	Route::get ( 'car/{id}', 'CarController@getCar' );
	Route::get ( 'car/edit/{id}', 'CarController@editCar' );
} );