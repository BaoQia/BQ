<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	
	<!-- 8 core css -->
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/style.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/fonts.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/magnific-popup.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/responsive.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/parsley.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/custom-bq.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('/css/override.css') }}" type="text/css" />	
    
  	 @yield('css')

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	
	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	
	<!-- Parsley localization files -->
	<script type="text/javascript" src="{{ asset('js/i18n/zh_cn.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/i18n/zh_tw.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('js/parsley.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>

    <!-- Use to load extra js -->
	@yield('javascript')

	<!-- Document Title
	============================================= -->
	<title>
		@section('title')
			BaoQia
		@show
	</title>
</head>
<body class="stretched">
	<div id="wrapper" class="clearfix">

	@section('header')
		@include('layouts.header')
	@show
	
	@yield('content')
	
	@section('footer')
		@include('layouts.footer')
	@show
    </div>
	<!-- Scripts -->
		<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
	<script type="text/javascript">
		var selectedLangName,  selectedLocale;

		selectedLocale  = '{{ LaravelLocalization::getCurrentLocale() }}';
		selectedLangName = '{{ LaravelLocalization::getCurrentLocaleNativeReading() }}';

		// TODO: Change in after click & Change in laravel locale name
		if (selectedLocale === 'zh') {
			selectedLocale = 'zh_cn';
		} else if (selectedLocale === 'zh-Hant') {
			selectedLocale = 'zh_tw';
		} else {
			selectedLocale = 'en';
		}
		
		window.ParsleyValidator.setLocale(selectedLocale);
		
		$(document).ready(function() {
			//-- Display Selected Language on menu
			$('#header-selected-lang').html(selectedLangName + '<span class="caret" style="display: inline-block;"></span>');
		});
	</script>
	@yield('fooder_javascript')
</body>
</html>
