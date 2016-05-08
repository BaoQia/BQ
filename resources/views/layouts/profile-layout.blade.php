@extends('layouts.app')

@section('header')
	@include('layouts.header-dark') 
@endsection 

@section('content')
		<!-- Content
        ============================================= -->
       	<section id="content" class='bg-my-account' style="background: #EEE">
            <div class="content-wrap">
                <div class="container clearfix">
					<!-- Side Navigation
						============================================= -->		
					  <!-- included file is based on selected sub menu item -->		
					  	@include('layouts.side-menu-profile')
					<script>
						$(document).ready(function() {
							//Convert pathname and match to tab 
              
              var path = window.location.pathname;
              path = path.toLowerCase();
              
              if (path.match(/updateavatar$/i)) {
                return 0;
              }
              if (path.match(/\/[a-z]+$/i) && path.match(/\/[a-z]+$/i).length > 0){
                var title = path.match(/\/[a-z]+$/i)[0];
                title = '#' + title.replace('/','');

                $(title).addClass('ui-tabs-active');
              }
              //Remove panel-body max-width for verification page
              if (path.match(/verification|createcar$/i) || path.match(/editcar\/\d+$/i)) {
                $('.panel-body').css('max-width','');
                $('.panel-body').css('background', '#F5F5F5');
              }
              
              //Remove panel-body max-width for my cars page
              if (path.match(/mycars|createcar$/i) || path.match(/editcar\/\d+$/i)) {
                $('.panel-body').css('max-width','');
                $('#mycars').addClass('ui-tabs-active');
              }
              
              //Remove verification tab, when role is not agent
              var url = "{{ url('role') }}";
              var roleResp = function(data) {
                if (data.role != 2) {
                  $('#verification').remove();
                  $('#mycars').remove();
                }
              }
              $.ajax({
                dataType: "json",
                url: url,
                success: roleResp
              });

						});
					</script>
					<!-- #side-navigation end -->

					<!-- Content Panel
						============================================= -->	
					<div class="col_three_fourth col_last nobottommargin bq-my-account-panel-v3">
						<div class="bq-my-account-title-row clearfix" >
							<h3 id="profile-title">@yield('profile-title')</h3>
						</div>
            
            @yield('profile-title-banner')
            
						<div class="clearfix">
							<!-- Content!!
							============================================= -->	
							<div class="panel-body" style="padding: 40px;max-width:600px" >
								@if(count($errors) > 0)
								<div class="alert alert-danger">
									@foreach ($errors->all() as $error)
									<p>{{ $error }}</p>
									@endforeach
								</div>
								@endif
								@if (Session::has('success'))
								<div class="alert alert-success">
									<p>{{ Session::get('success') }}</p>
								</div>
								@endif

								@yield('profile-form')
								
							</div>
							<!-- content end -->
						</div>
					</div>			
					<!-- Content Panel end -->
				</div>			
			</div>
		</section>
		<!-- #content end -->
@endsection



