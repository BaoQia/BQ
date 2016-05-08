@extends('layouts.auth') 

@section('title') 
BaoQia - {{ trans('messages.login') }}
@endsection	

@section('page-title')
	{{ trans('messages.login') }}
@endsection	
	
@section('auth-form') 
	<form id="login-form" data-parsley-validate name="login-form"
		class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/auth/login') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h3>{{ trans('messages.loginToYourAccount') }}</h3>
	
		<div class="col_full">
			<label for="login-form-email">{{ trans('messages.email') }}:</label> <input type="email"
				id="login-form-email" name="email" required
				value="{{ old('email') }}" class="form-control" />
		</div>
		<div class="col_full">
			<label for="login-form-password">{{ trans('messages.password') }}:</label> <input
				type="password" id="login-form-password" name="password" required
				value="" class="form-control" />
		</div>
		<div class="col_full">
			<div class="checkbox">

					<label> <input type="checkbox" name="remember"> {{ trans('messages.rememberMe') }}
					</label>
					<a href="{{ url('/password/email') }}" class="bq-forgot-password-link">{{ trans('messages.forgotPassword') }}?</a>
			</div>
		</div>
		<div class="col_full nobottommargin">
			<button type="submit" class="button button-3d button-green nomargin"
				id="login-form-submit" name="login-form-submit" value="login">{{ trans('messages.login') }}</button>
			
		</div>
	</form>
	<div class="bq-login-signup-link">
		<a href="{{ url('/auth/register') }}">{{ trans('messages.noAccountYetSignUp') }}</a>
	</div>
	<div class="line line-sm"></div>
	<div class="center">
		<h4 style="margin-bottom: 15px;">{{ trans('messages.orLoginWith') }}:</h4>
		<a href="/auth/fblogin"
			class="button button-rounded si-facebook si-colored">Facebook</a>
	</div>
@endsection

