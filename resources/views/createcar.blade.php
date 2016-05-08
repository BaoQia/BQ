@extends('layouts.profile-layout')

@section('profile-title')
{{ trans('messages.myCars') }}
@endsection

@section('javascript') 
<link rel="stylesheet" type="text/css" href="{{ asset('/css/basic.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dropzone.min.css') }}">

<script type="text/javascript">
  $(document).ready(function() {
    $('#plateNumber').blur(function(){
      @if($formType == "edit")
        if ($('#plateNumber').val() == {{$data['plate_number']}}) {
          return;
        }
      @endif
      $.getJSON("{{ url(LaravelLocalization::getCurrentLocale().'/checkCarPlate') }}",
        {plateNumber : $('#plateNumber').val()}
      ).done(function(data) {
        if (data == 'duplicated') {
          $('.plateNumberStatus').html('<div class=\'alert alert-danger\'><p>Same plate number is added.</p></div>');
        } else {
          $('.plateNumberStatus').html('');
        }
      });
    });
    
    $('#plateNumber').focus(function(){
      $('.plateNumberStatus').html('');
    });
    @if($formType == "edit")
    $('#select-seats').val({{$data['seats']}});
    $('#select-doors').val({{$data['doors']}});

    var carId = window.location.pathname.match(/\d+$/i)[0];
    var formActionUrl = "{{ url(LaravelLocalization::getCurrentLocale().'/carphotos') }}";
    document.getElementById('myDropzone').action = formActionUrl + "/" + carId;
    @endif
 
  });
  


</script>
<script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
@endsection

@section('profile-title-banner')
<div class="col_full">
  <div class="col-7 col-center text-center">
    @if($formType != "edit")
      <h1 class="h3">Add Your Car</h1>
    @else
		  <h1 class="h3">Edit Your Car</h1>				
	  @endif
    <p class="text-lead">
      Later can link it to your package.
    </p>
  </div>
</div>
@endsection

@section('profile-form')
<form id="createcar-form" name="createcar-form" class="nobottommargin" action=
@if($formType == "edit") 
"{{ url(LaravelLocalization::getCurrentLocale().'/editcar/save/'.$data['id']) }}" 
@else 
"{{ url(LaravelLocalization::getCurrentLocale().'/createcar') }}"
@endif
method=@if($formType == "edit") 
"PUT" 
@else 
"POST"
@endif
 data-parsley-validate>
  <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row row-space">
      <div class="col-md-3 text-center">
        <div class="h4">Basic</div>
      </div>
      <div class="col-md-9 text-left">
        <div class="row row-space">
          <div class="col-md-6">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Seats</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <select name="seats" id="select-seats" class="form-control no-margin">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Doors</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <select name="doors" id="select-doors" class="form-control no-margin">
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Plate Number<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input id="plateNumber" type="text" value=@if($formType == "edit") {{$data['plate_number']}} @else "" @endif class="form-control no-margin" name="plateNumber" required maxlength="50" data-parsley-trigger="change" data-parsley-maxlength="50" data-parsley-required>
                <div class="plateNumberStatus">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Manufacturer<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['manufacturer']}} @else "" @endif class="form-control no-margin" placeholder="Eg: Toyota, Honda" name="manufacturer" required maxlength="50" data-parsley-trigger="change" data-parsley-maxlength="50">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Model<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['model']}} @else "" @endif class="form-control no-margin" placeholder="Eg: Vios, City, Wish, Vellfire" name="model" data-parsley-trigger="change" required maxlength="50" data-parsley-maxlength="50" data-parsley-required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Year of Manufacturing<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['year']}} @else "" @endif class="form-control no-margin" name="year" required type="range" data-parsley-trigger="change" data-parsley-range="[1995,2015]" data-parsley-required data-parsley-error-message="Enter Year between 1995 to 2015." maxlength="4" data-parsley-maxlength="4">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-space">
      <div class="col-md-3 text-center">
        <div class="row row-space">
          <div class="h4">Hire Package</div>
        </div>
      </div>
      <div class="col-md-9 text-left">
        <div class="row row-space">
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Booking Price<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['booking_price']}} @else "" @endif class="form-control no-margin" placeholder="" name="bookingPrice" data-parsley-trigger="change" required data-parsley-required data-parsley-pattern="^\d*$" data-parsley-error-message="Enter price. (without cents)">
              </div>
            </div>
          </div>
        </div>
        <div class="row row-space">
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Total Hour per Booking<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['total_booking_hour']}} @else "" @endif class="form-control no-margin" placeholder="" name="timePerBooking" data-parsley-trigger="change" required  maxlength="2" data-parsley-required data-parsley-pattern="^\d*$" data-parsley-range="[0,24]"  data-parsley-error-message="Enter total hour per booking. (Maximum: 24Hr)">
              </div>
            </div>
          </div>
        </div>
        <div class="row row-space">
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Over Time Charge per Hour<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['ot_price']}} @else "" @endif class="form-control no-margin" placeholder="" name="otCharge" data-parsley-trigger="change" required data-parsley-required data-parsley-error-message="Enter over time charge per hour. (without cents)" data-parsley-pattern="^\d*$">
              </div>
            </div>
          </div>
        </div>
        <div class="row row-space">
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Late Night Charge<span class="bq-required-label">*</span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['late_night_charge']}} @else "" @endif class="form-control no-margin" placeholder="" name="lateNightCharge" data-parsley-trigger="change" required data-parsley-required data-parsley-pattern="^\d*$" data-parsley-error-message="Enter late night charge. (without cents)">
              </div>
            </div>
          </div>
        </div>
        <div class="row row-space">
          <div class="col-md-4">
            <div class="row text-left">
              <div class="row row-space">
                <div class="h5">Insurance Coverage per Person</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <input type="text" value=@if($formType == "edit") {{$data['insurance_price']}} @else "" @endif class="form-control no-margin" name="insurance" data-parsley-trigger="change" data-parsley-pattern="^\d*$" data-parsley-error-message="Enter Insurance Coverage per Person. (without cents)">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  @if($formType == "edit")
  <div class="row row-space">
      <div class="col-md-3 text-center">
        <div class="row row-space">
          <div class="h4">Photos</div>
        </div>
      </div>
      <div class="col-md-9 text-left">
        <div class="row row-space">
          <div class="col-md-12">
            <div class="text-center">
              <div class="row-space"><i class="icon-camera h1"></i></div>
              <div class="h5 row-space">Add Photos</div>
              <p class="text-lead text-muted row-space">Even photos taken on your phone can help travelers visualize your car.</p>
            </div>
            <form id="myDropzone" class="nobottommargin dropzone"  >
              <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="dz-default dz-message">
                <p class="text-lead text-muted row-space">Drop files here to upload your car photo.</p>
                <p class="text-lead text-muted row-space">Max file size is 3MB.</p>
                <p class="text-lead text-muted row-space">Only can upload 5 photos.</p>
              </div>
            </form>
            <script>
              Dropzone.options.myDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 3, // MB
                maxFiles: 5,
                dictMaxFilesExceeded: "You can not upload any more files.",
                dictDefaultMessage: "Drop files here to upload",
                dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
                dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                dictFileTooBig: "Max filesize: 3MB.",
                dictInvalidFileType: "You can't upload files of this type.",
                dictResponseError: "Server responded with error code.",
                dictCancelUpload: "Cancel upload",
                dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
                dictRemoveFile: "Remove file",
                dictRemoveFileConfirmation: null,
                dictMaxFilesExceeded: "You can not upload any more files.",
                accept: function(file, done) {
                  //Only accept image file
                  var ext = file.name.match(/\.(.+)$/)[1];
                  switch (ext) {
                      case 'jpg':
                      case 'jpeg':
                      case 'png':
                          done();
                          break;
                      default:
                           done("Only file type jpg, jpeg, and png is allowed.");
                  }
                },
                init: function() {
                  this.on("addedfile", function(file) {

                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class=\"button button-green \">Remove</button>");


                    // Capture the Dropzone instance as closure.
                    var _this = this;

                    // Listen to the click event
                    removeButton.addEventListener("click", function(e) {
                      // Make sure the button click doesn't submit the form:
                      e.preventDefault();
                      e.stopPropagation();
                      
                      

                      // If you want to the delete the file on the server as well,
                      // you can do the AJAX request here.
                      var xhr = new XMLHttpRequest();
                      var url = "{{ url(LaravelLocalization::getCurrentLocale().'/removeCarPhoto') }}" + '/' + file.xhr.responseText.replace(/\"/g,'');
                      xhr.open('POST', url, true);
                      xhr.setRequestHeader("X-CSRF-TOKEN", $('#token').val());
                      xhr.onreadystatechange = function () {
                      if (xhr.readyState === 4 && xhr.status === 200) {
                        _this.removeFile(file);
                      }
                      };
                      xhr.send();
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                  });
                }
              };
            </script>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="row row-space">
      <div class="col-md-3 text-center">
          <button class="button button-3d button-green btn-block" type="submit">
          @if($formType != "edit")
            Add
          @else
            Edit
          @endif
          </button>
      </div>
      <div class="col-md-9 text-center">
      </div>
    </div>

@endsection



