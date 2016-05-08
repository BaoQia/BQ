@extends('layouts.profile-layout')

@section('javascript') 
<script>
  $(document).ready(function() {
        $('INPUT[type="file"]').change(function () {
            $('.alert-danger').remove();
            var ext = this.value.match(/\.(.+)$/)[1];

            if(this.files[0].size > 3000000) {
              $('#uploadavatar-form').prepend('<div class=\'alert alert-danger\'><p>Upload profile image size must be less than 5MB.</p></div>');
              $('#fileuploadbtn').attr('disabled', true);
              return;
            }
            ext = ext.toLowerCase();
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                    $('#fileuploadbtn').removeAttr('disabled');
                    break;
                default:
                    $('#uploadavatar-form').prepend('<div class=\'alert alert-danger\'><p>Only file type jpg, jpeg, and png is allowed.</p></div>');
                    $('#fileuploadbtn').attr('disabled', true);
                    this.value = '';
            }
        });
    });
</script>

@endsection
@section('profile-title')
{{ trans('messages.updateProfilePicture') }}
@endsection

@section('profile-form')

<form id="uploadavatar-form" name="uploadavatar-form" class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/updateavatar') }}" method="POST" enctype="multipart/form-data" >
	<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
	<div style="max-width:600px">
   	   <div class="col_full sm-form-control nobottommargin">
          <input type="file" name="avatar" id="imagetoupload" required>
       </div>
       <p>**Important: Upload less than 300kB each, then click submit.</p>
       <div class="col_full">
           <button class="button button-3d button-green nomargin" id="fileuploadbtn" name="uploadavatar-form-submit" value="avatar" disabled>{{ trans('messages.uploadPicture') }}</button>
       </div>

    </div>
  
</form>
@endsection



