@extends('layouts.auth') 

@section('title', 'BaoQia') 

@section('page-title')
	{{ trans('messages.waitingActivation') }}
@endsection

@section('auth-form') 
	<form id="resend-verification-form"
		class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/auth/verify') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h3>{{ trans('messages.notYetActivated') }}</h3>
		<div class="col_full nobottommargin">
			<button type="submit" class="button button-3d button-green nomargin"
				id="resend-verification-form-submit">
				{{ trans('messages.resendActivationLink') }}
			</button>
		</div>
	</form>
@endsection