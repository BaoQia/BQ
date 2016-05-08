@extends('layouts.auth') 

@section('title')
	BaoQia - {{ trans('messages.forgotPassword') }}
@endsection

@section('page-title')
	{{ trans('messages.forgotPassword') }}
@endsection 

@section('auth-form') 
<form id="send-reset-form" name="send-reset-form" data-parsley-validate class="nobottommargin"
	action="{{ url(LaravelLocalization::getCurrentLocale().'/password/email') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h3>{{ trans('messages.resetYourAccountPassword') }}</h3>
	<div class="col_full">
		<label for="send-reset-form-email">{{ trans('messages.email') }}:</label> 
		<input type="email"
			id="send-reset-form-email" name="email" required
			value="{{ old('email') }}" class="form-control" />
	</div>
	<div class="col_full nobottommargin">
		<button type="submit" class="button button-3d button-green nomargin"
			id="send-reset-form-submit">{{ trans('messages.sendResetLink') }}</button>
	</div>
</form>

@endsection
