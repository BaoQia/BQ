@extends('layouts.app') 

@section('header')
	@include('layouts.header-dark') 
@endsection 

@section('content')
<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1>@yield('page-title')</h1>
	</div>
</section>
<!-- #page-title end -->
<!-- Content
        ============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="tabs divcenter nobottommargin clearfix"
				id="tab-login-register" style="max-width: 500px;">
				<div class="tab-container">
					<div class="tab-content clearfix" id="tab-login">
						<div class="panel panel-default nobottommargin">
							<div class="panel-body" style="padding: 40px;">
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										@foreach ($errors->all() as $error)
											<p>{{ $error }}</p>
										@endforeach
									</div>
								@endif @if (Session::has('success'))
									<div class="alert alert-success">
										<p>{{ Session::get('success') }}</p>
									</div>
								@endif @if (Session::has('fail'))
									<div class="alert alert-danger">
										<p>{{ Session::get('fail') }}</p>
									</div>
								@endif
								@yield('auth-form')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- #content end -->
@endsection