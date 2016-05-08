@extends('layouts.profile-layout')

@section('javascript') 
<script type="text/javascript">
  $(document).ready(function() {
        var dlHTML = $('.add-dl-field').html();
        var idHTML = $('.add-id-field').html();

          $('INPUT[type="file"]').change(function () {
              $('.alert-danger').remove();
              var ext = this.value.match(/\.(.+)$/)[1];
              var buttonId = '#' + this.id + '-uploader';
              if(this.files[0].size > 300000) { //300kB
                $('#verification-form').prepend('<div class=\'alert alert-danger\'><p>Upload image file must be less than 300KB.</p></div>');
                $(buttonId).addClass('bq-alert-text-color');
                return;
              }
              ext = ext.toLowerCase();
              switch (ext) {
                  case 'jpg':
                  case 'jpeg':
                  case 'png':
                      $(buttonId).addClass('bq-sudless-text-color');
                      break;
                  default:
                      $('#verification-form').prepend('<div class=\'alert alert-danger\'><p>Only file type jpg, jpeg, and png is allowed.</p></div>');
                      this.value = '';
              }
          });
          
          function initId() {
            $('#f_id_c-uploader').click(function() {
              $('#f_id_c').click();
            });
            $('#b_id_c-uploader').click(function() {
              $('#b_id_c').click();
            });
            $('#id_c-submit').click(function() {
              var front = document.getElementById('f_id_c'),
                  back  = document.getElementById('b_id_c');
              
              filevalidation(front,back);
            });
          };

          function initDl() {
            $('#f_dl_c-uploader').click(function() {
              $('#f_dl_c').click();
            });
            $('#b_dl_c-uploader').click(function() {
              $('#b_dl_c').click();
            });
            $('#dl_c-submit').click(function() {
               var front = document.getElementById('f_dl_c'),
                   back  = document.getElementById('b_dl_c');
              filevalidation(front,back);
            });
          };

          var filevalidation = function(frontElem,backElem) {
            var frontFieldTextId = frontElem.name.replace('_c','');
            var frontCoverType = frontElem.id.concat('-uploader');
            var backCoverType = backElem.id.concat('-uploader');
            var fileType = frontElem.id.match(/._(.*)_./i)[1]; //ic or dl
            var resultTextField = '.add-' + fileType + '-field';
            
            $('.alert-danger').remove();
            if (frontElem.files[0] == null && backElem.files[0] != null) {
              $('#verification-form').prepend('<div class=\'alert alert-danger\'><p>Kindly attach '+ document.getElementById(frontFieldTextId).innerText+ ' ' + document.getElementById(frontCoverType).innerText.toLowerCase() + '.</p></div>');
            } else if (frontElem.files[0] != null && backElem.files[0] == null) {
              $('#verification-form').prepend('<div class=\'alert alert-danger\'><p>Kindly attach '+ document.getElementById(frontFieldTextId).innerText+ ' ' + document.getElementById(backCoverType).innerText.toLowerCase() + '.</p></div>');
            } else if (frontElem.files[0] == null && backElem.files[0] == null) {
              $('#verification-form').prepend('<div class=\'alert alert-danger\'><p>Kindly attach '+ document.getElementById(frontFieldTextId).innerText+ ' ' + document.getElementById(frontCoverType).innerText.toLowerCase() + ' and '+ document.getElementById(backCoverType).innerText.toLowerCase() + '.</p></div>');
            } else if (frontElem.files[0] != null && backElem.files[0] != null) {
              //$(resultTextField).html("<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"><\/span>");
              var formData = new FormData();
              var totalFileSize = frontElem.files[0].size + backElem.files[0].size;
              formData.append('frontCover', frontElem.files[0], frontElem.files[0].name);
              formData.append('backCover', backElem.files[0], backElem.files[0].name);

              var xhr = new XMLHttpRequest();
              var url = "{{ url(LaravelLocalization::getCurrentLocale().'/verification/upload') }}" + "/" + fileType;
              xhr.open('POST', url, true);
              xhr.setRequestHeader("X-CSRF-TOKEN", $('#token').val());
              
              xhr.upload.addEventListener("progress", function(evt) {
                  var loaded = (evt.loaded / totalFileSize).toFixed(2)*100; // percent
                  $(resultTextField).html("<div class='h5 text-center'>Uploading..." + loaded + "%</div>" );
              }, false);

              xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                  $(resultTextField).html("<div class='h5 text-center'>Thank you, we will get back to you in 3 days and stay tuned.</div>");
                } else if (xhr.readyState === 4 && xhr.status != 200){
                  $(resultTextField).html("<div class='h5 text-center bq-alert-text-color'> There is an error. Please try again later.</div>" );
                }
              };
              xhr.send(formData);
            }
          }
        var updateStatus = function() {
          var xhr = new XMLHttpRequest();
          var url = "{{ url(LaravelLocalization::getCurrentLocale().'/verification/status') }}";
          xhr.open('GET', url, true);
          xhr.setRequestHeader("X-CSRF-TOKEN", $('#token').val());
           xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              var vstatus = JSON.parse(xhr.responseText);
              if (vstatus.ic_status == 'A') {
                $('.add-id-field').html("<div class='h5 text-center'>Thank you, we will get back to you soon.</div>");
              }
              
              if (vstatus.driver_license_status == 'A') {
                $('.add-dl-field').html("<div class='h5 text-center'>Thank you, we will get back to you soon.</div>");
              }
              
              if (vstatus.ic_status == 'C') {
                $('.add-id-field').html("<div class='h5 text-center'>Verified.</div>");
              }
              
              if (vstatus.driver_license_status == 'C') {
                $('.add-dl-field').html("<div class='h5 text-center'>Verified.</div>");
              }
              
              if (vstatus.ic_status == 'F') {
                $('.add-id-field').html("<div class='h5 text-center'>Verified.</div>");
              }
              
              if (vstatus.driver_license_status == 'F') {
                $('.add-dl-field').html("<div class='h5 text-center'>Fail Verification. <a id='tryDl'>Try again</a></div>");
                $('#tryDl').click(function(){$('.add-dl-field').html(dlHTML);
                  initDl();
                });
              }

              if (vstatus.ic_status == 'F') {
                $('.add-id-field').html("<div class='h5 text-center'>Fail Verification. <a id='tryId'>Try again</a></div>");
                $('#tryId').click(function(){$('.add-id-field').html(idHTML);
                  initId();
                });
                
              }
            }
          };
          xhr.send();
        }

        initId();
        initDl();
        updateStatus();
    });
</script>

@endsection

@section('profile-title')
Verification
@endsection

@section('profile-title-banner')
<div class="col_full">
  <div class="col-7 col-center text-center">
    <h1 class="h3">Verify Yourself</h1>
    <p class="text-lead">
      To improve your trust in Baoqia community.
    </p>
  </div>
</div>
@endsection

@section('profile-form')
<form id="verification-form" name="verification-form" class="nobottommargin" action="{{ url(LaravelLocalization::getCurrentLocale().'/verification/update') }}">
	<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="row row-space">
    <div class="col-md-3 text-center">
      <div class="row row-space">
        <div id='f_id' class="h4">Identification Card</div>
      </div>
    </div>
    <div class="col-md-9 text-left">
      <div class="row row-space">
        <div class="col-md-12">
          <div class="text-left">
            <div class="add-id-field">
              <input type="file" id="f_id_c" name="f_id_c" class="hide">
              <input type="file" id="b_id_c" name="f_id_c" class="hide">
              <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="f_id_c-uploader" type="button">
                    <i class="icon-cloud-upload"></i> Front Cover
                  </button>
                </div>
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="b_id_c-uploader" type="button">
                    <i class="icon-cloud-upload"></i> Back Cover
                  </button>
                </div>
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="id_c-submit" type="button">
                    <i class="icon-cloud-upload"></i> Submit
                  </button>
                </div>
              </div>
              <p>**Important: Upload less than 300kB each, then click submit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-space">
    <div class="col-md-3 text-center">
      <div class="row row-space">
        <div id='f_dl' class="h4">Driver License</div>
      </div>
    </div>
    <div class="col-md-9 text-left">
      <div class="row row-space">
        <div class="col-md-12">
          <div class="text-left">
            <div class="add-dl-field">
              <input type="file" id="f_dl_c" name="f_dl_c" class="hide">
              <input type="file" id="b_dl_c" name="b_dl_c" class="hide">
              <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="f_dl_c-uploader" type="button">
                    <i class="icon-cloud-upload"></i> Front Cover
                  </button>
                </div>
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="b_dl_c-uploader" type="button">
                    <i class="icon-cloud-upload"></i> Back Cover
                  </button>
                </div>
                <div class="btn-group" role="group">
                  <button class="btn btn-default" id="dl_c-submit" type="button">
                    <i class="icon-cloud-upload"></i> Submit
                  </button>
                </div>
              </div>
              <p>**Important: Upload less than 300kB each, then click submit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection