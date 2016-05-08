@extends('layouts.auth') 
@section('title')
	BaoQia - {{ trans('messages.signUp') }}
@endsection

@section('page-title')
	{{ trans('messages.signUp') }}
@endsection 

@section('auth-form') 
<h3>{{ trans('messages.signUpForAnAccount') }}</h3>
<form id="register-form" data-parsley-validate name="register-form"
	class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/auth/register') }}"
	method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col_full">
		<label>{{ trans('messages.accountType') }}: </label><br />
		<div class="btn-group center" data-toggle="buttons">
			<label class="btn bq-user-category
				@if ( old('user_role_id')  == 3 || old('user_role_id')  == '')
					active
				@endif
			"> 
				<input type="radio"
					name="user_role_id" id="traveller" value="3" 
						@if ( old('user_role_id')  == 3 || old('user_role_id')  == '')
							checked
						@endif
					> {{ trans('messages.traveller') }}
			</label> 
			<label class="btn bq-user-category
				@if ( old('user_role_id') == 2)
					active
				@endif 
			"> 
				<input type="radio"
					name="user_role_id" id="agent" value="2" 
						@if ( old('user_role_id') == 2)
							checked
						@endif 
					> {{ trans('messages.driverAgent') }}
			</label>
		</div>
	</div>
	<div class="col_full">
		<label for="register-form-name">{{ trans('messages.name') }}:</label>
		<span class="bq-required-label">*</span> 
		<input type="text"
			id="register-form-name" name="name" value="{{ old('name') }}"
			class="form-control" required />
	</div>

	<div class="col_full">
		<label for="register-form-email">{{ trans('messages.emailAddress') }}:</label>
		<span class="bq-required-label">*</span>
		<input type="email"
			id="register-form-email" name="email" required
			value="{{ old('email') }}" class="form-control" />
	</div>
	<div class="col_full">
		<label for="register-form-phone">{{ trans('messages.phoneNumber') }}:</label>
		<span class="bq-required-label">*</span>
		<input type="tel"
			value="{{ old('phone_number') }}"
			id="register-form-phone" required pattern="[0-9]*"
			data-parsley-type="number" name="phone_number" class="form-control" />
	</div>

	<div class="col_full">
		<label for="register-form-password">{{ trans('messages.password') }}:</label>
		<span class="bq-required-label">*</span>
		<input type="password"
			id="register-form-password" required
			name="password"
			class="form-control" data-parsley-minlength="6" />
	</div>

	<div class="col_full">
		<label for="register-form-repassword">{{ trans('messages.confirmPassword') }}:</label>
		<span class="bq-required-label">*</span>
		<input type="password"
			id="register-form-repassword"
			data-parsley-equalto="#register-form-password"
			data-parsley-error-message="Password not match" required
			name="password_confirmation" class="form-control" />
	</div>

	<div class="col_full nobottommargin">
		<button class="button button-3d button-green nomargin" type="submit"
			id="register-form-submit" name="register-form-submit"
			value="register">{{ trans('messages.signUp') }}</button>
	</div>
</form>
<div class="bq-login-signup-link">
	<a href="{{ url('/auth/login') }}">{{ trans('messages.alreadyHaveAnAccount') }}</a>
</div>
<div class="line line-sm"></div>
<div id="social-media-login" class="center">
	<h4 style="margin-bottom: 15px;">{{ trans('messages.orSignUpWith') }}:</h4>
	<a href="/auth/fblogin" class="button button-rounded si-facebook si-colored">Facebook</a>
</div>

@endsection

@section('fooder_javascript')
<script>
	$(document).ready(function(){

		// Hide login with social media for agent
		$('input[type=radio][name=user_role_id]').change(function() {
	        if (this.value == '2') {// Agent
	            $('#social-media-login').hide();
	        }
	        else if (this.value == '3') { // Traveller
	        	$('#social-media-login').show();
	        }
	    });
	});
</script>
@endsection
