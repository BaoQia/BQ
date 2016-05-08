@extends('layouts.profile-layout')

@section('profile-title')
{{ trans('messages.changePassword') }}
@endsection

@section('profile-form')
<form id="changepassword-form" name="changepassword-form" class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/changepassword/update') }}" method="POST" data-parsley-validate>
	<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
       <div style="max-width:600px">
           <div class="col_full">
               <label for="changepassword-form-old-password">{{ trans('messages.oldPassword') }}</label>
               <span class="bq-required-label">*</span>
               <input type="password"
				id="changepassword-form-password" required
				placeholder="{{ trans('messages.oldPassword') }}" name="oldPassword"
				class="form-control" data-parsley-minlength="6" />
           </div>
           <div class="col_full">
               <label for="changepassword-form-new-password">{{ trans('messages.newPassword') }}</label>
               <span class="bq-required-label">*</span>
               <input type="password"
				id="changepassword-form-password" required
				placeholder="{{ trans('messages.newPassword') }}" name="newPassword"
				class="form-control" data-parsley-minlength="6" />
           </div>
           <div class="col_full">
               <label for="changepassword-form-confirm-new-password">{{ trans('messages.confirmNewPassword') }}</label>
               <span class="bq-required-label">*</span>
               <input type="password"
					id="changepassword-form-password" required
					placeholder="{{ trans('messages.confirmNewPassword') }}" name="confirmNewPassword"
					class="form-control" data-parsley-minlength="6" />
           </div>
       </div>
       <div class="row">
           <div class="nobottommargin col-md-12">
               <button class="button button-3d button-green nomargin" id="changepassword-form-submit" name="changepassword-form-submit" value="changePassword">{{ trans('messages.updatePassword') }}</button>
           </div>
       </div>
</form>
@endsection



