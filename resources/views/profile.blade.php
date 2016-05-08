@extends('layouts.profile-layout')


@section('profile-title')
{{ trans('messages.profile') }}
@endsection

@section('profile-form')
<form id="profile-form" name="profile-form" class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/profile/update') }}" method="POST" data-parsley-validate>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col_full">
		<label for="profile-form-name">{{ trans('messages.name') }}</label>
		<span class="bq-required-label">*</span>
		<input type="text" id="profile-form-name" name="name" value="{{Auth::user()->name}}" class="sm-form-control" required/>
	</div>
	<div class="col_full">
		<label for="profile-form-email">{{ trans('messages.emailAddress') }}</label>
		<span class="bq-required-label">*</span>
		<input type="text" id="profile-form-email" name="email" value="{{Auth::user()->email}}" class="sm-form-control" disabled/>
	</div>
	<div class="col_full">
		<label for="profile-form-phone">{{ trans('messages.phoneNumber') }}</label>
		<span class="bq-required-label">*</span>
		<input type="tel"
			id="profile-form-phone" required pattern="[0-9]*"
			data-parsley-type="number" name="phone_number" value="{{Auth::user()->phone_number}}" class="sm-form-control" />
	</div>
	<div class="col_full nobottommargin">
		<button class="button button-3d button-green nomargin" id="register-form-submit" name="profile-form-submit" value="updateProfile">{{ trans('messages.updateProfile') }}</button>
	</div>
</form>

@endsection



