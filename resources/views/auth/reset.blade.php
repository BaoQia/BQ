@extends('layouts.auth') 

@section('title')
	BaoQia - {{ trans('messages.resetPassword') }}
@endsection

@section('page-title') 
	{{ trans('messages.resetPassword') }}
@endsection

@section('auth-form') 
	<form data-parsley-validate id="reset-password-form" name="reset-password-form" class="nobottommargin"
		action="{{ url(LaravelLocalization::getCurrentLocale().'/password/reset') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="col_full">
			<label for="reset-password-form-email">{{ trans('messages.email') }}:</label> 
			<input type="email"
				id="reset-password-form-email" name="email" required
				value="{{ old('email') }}" class="form-control" />
		</div>
		<div class="col_full">
			<label for="reset-password-form-password">{{ trans('messages.password') }}:</label> 
			<input type="password"
				id="reset-password-form-password" name="password" required
				data-parsley-minlength="6"
				class="form-control" />
		</div>
		<div class="col_full">
			<label for="reset-password-form-confirm-password">{{ trans('messages.confirmPassword') }}:</label> 
			<input type="password"
				id="reset-password-form-confirm-password" name="password_confirmation" required
				data-parsley-equalto="#reset-password-form-password"
				data-parsley-error-message="Password not match" 
				class="form-control" />
		</div>				
		<div class="col_full nobottommargin">
			<button type="submit" class="button button-3d button-green nomargin"
				id="password-reset-form-submit">{{ trans('messages.resetPassword') }}</button>
		</div>
	</form>
		
@endsection
