@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('/css/travel.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('/css/datepicker.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('/css/colors.php?color=AC4147') }}" type="text/css" />

@endsection

@section('javascript')

<script type="text/javascript" src="{{ asset('js/datepicker.js') }}"></script>

@endsection

@section('content')

<section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">

			<div class="fslider" data-speed="3000" data-pause="7500" data-animation="fade" data-arrows="false" data-pagi="false" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; background-color: #333;">
				<div class="flexslider">
					<div class="slider-wrap">
						<div class="slide full-screen force-full-screen" style="background: url('images/slider/1.jpg') center center; background-size: cover; height: 100% !important;"></div>
						<div class="slide full-screen force-full-screen" style="background: url('images/slider/2.jpg') center center; background-size: cover; height: 100% !important;"></div>
						<div class="slide full-screen force-full-screen" style="background: url('images/slider/3.jpg') center center; background-size: cover; height: 100% !important;"></div>
					</div>
				</div>
			</div>

			<div id="travel-slider-overlay">

				<div class="vertical-middle">

					<div class="container clearfix">

						<div class="tabs travel-organiser-tabs clearfix">

							<ul class="tab-nav clearfix">
								<li><a href="#tab-holidays"><i class="icon-gift"></i><span class="hidden-xs">{{ trans('messages.holidays') }}</span></a></li>
							</ul>

							<div class="tab-container">
								<div class="tab-content clearfix" id="tab-holidays">
									<div class="heading-block nobottomborder bottommargin-sm clearfix">
										<h4>Search for Holiday Packages</h4>
									</div>
									<form action="#" method="post" class="nobottommargin">
										<div class="row">
											<div class="col-sm-12 col-xs-12 bottommargin-sm">
												<label for="">Destination</label>
												<select name="destination" class="sm-form-control">
													<option value="">-- Select Destination --</option>
													<option value="taipei">Taipei</option>
													<option value="taichung">Taichung</option>
													<option value="tainan">Tainan</option>
												</select>
											</div>
											<div class="clear"></div>
											<div class="col-sm-9 bottommargin-sm">
												<div class="row">
													<div class="col-sm-6 col-xs-6">
														<label for="">Start Date</label>
														<select name="month" class="sm-form-control">
															<option value="">-- Select Month --</option>
															<option value="November 2014">November 2014</option>
															<option value="December 2014">December 2014</option>
															<option value="January 2015">January 2015</option>
															<option value="February 2015">February 2015</option>
															<option value="March 2015">March 2015</option>
															<option value="April 2015">April 2015</option>
															<option value="May 2015">May 2015</option>
															<option value="June 2015">June 2015</option>
														</select>
													</div>
                          	<div class="col-sm-6 col-xs-6">
														<label for="">End Date</label>
														<select name="month" class="sm-form-control">
															<option value="">-- Select Month --</option>
															<option value="November 2014">November 2014</option>
															<option value="December 2014">December 2014</option>
															<option value="January 2015">January 2015</option>
															<option value="February 2015">February 2015</option>
															<option value="March 2015">March 2015</option>
															<option value="April 2015">April 2015</option>
															<option value="May 2015">May 2015</option>
															<option value="June 2015">June 2015</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-3 bottommargin-sm">
												<label for="">Adults</label>
												<input type="number" min="2" max="10" value="" class="sm-form-control" name="end" placeholder="2">
											</div>
											<div class="col-sm-12">
												<a href="car-list-v2.php" class="button button-3d nomargin rightmargin-sm">Search Availability</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</section>
		
<section id="content">

			<div class="content-wrap">

				<div class="section bottommargin-lg header-stick">
					<div class="container clear-bottommargin clearfix">

					<div class="row topmargin-sm bottommargin-sm text-center">

						<div class="col-md-6 col-sm-6 bottommargin">
							<i class="i-plain color i-large icon-line2-present inline-block" style="margin-bottom: 15px;"></i>
							<div class="heading-block nobottomborder nobottommargin">
								<span class="before-heading">Explore Destinations.</span>
								<h4>Holiday Packages</h4>
							</div>
						</div>

						<div class="col-md-6 col-sm-6 bottommargin">
							<i class="i-plain color i-large icon-line2-earphones-alt inline-block" style="margin-bottom: 15px;"></i>
							<div class="heading-block nobottomborder nobottommargin">
								<span class="before-heading">24x7 Dedicated Helpline.</span>
								<h4>1800 105 2541</h4>
							</div>
						</div>

					</div>

				</div>

			</div>

				<div class="container clearfix">

					<div class="heading-block center nobottomborder">
						<span class="before-heading color">What are you in the Mood for.?</span>
						<h2>Tailor made Packages for you</h2>
					</div>

				</div>

				<div id="portfolio" class="portfolio-nomargin portfolio-full portfolio-overlay-open clearfix">

					<article class="portfolio-item pf-media pf-icons">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/1.jpg" alt="Beach Activities">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Snorkeling Activities</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-illustrations">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/2.jpg" alt="Romantic Getaways">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Romantic Getaways</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-graphics pf-uielements">
						<div class="portfolio-image">
							<a href="#">
								<img src="images/packages/3.jpg" alt="Mountain Madness">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Night Markets</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-icons pf-illustrations">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/4.jpg" alt="Active Explorer">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Culture Explorer</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-uielements pf-media">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/5.jpg" alt="Icy Challenge">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Temple Visits</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-graphics pf-illustrations">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/6.jpg" alt="Hill Trekking">
								<div class="portfolio-overlay" data-lightbox="gallery">
									<div class="portfolio-desc">
										<h3>Hot Air Balloon</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-uielements pf-icons">
						<div class="portfolio-image">
							<a href="portfolio-single-video.html">
								<img src="images/packages/7.jpg" alt="Forest Camping">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Festivals Experiences</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

					<article class="portfolio-item pf-graphics">
						<div class="portfolio-image">
							<a href="portfolio-single.html">
								<img src="images/packages/8.jpg" alt="River Rafting">
								<div class="portfolio-overlay">
									<div class="portfolio-desc">
										<h3>Landmarks Captures</h3>
									</div>
								</div>
							</a>
						</div>
					</article>

				</div>

				<div class="section topmargin-lg footer-stick">
					<div class="container center clearfix">
						<div class="heading-block bottommargin-sm nobottomborder">
							<span class="before-heading color">Create a Custom Plan based on your Taste</span>
							<h2>Start making your Travel Plans</h2>
						</div>

						<p class="lead">Educate, aid, criteria catalyst John Lennon. Life-saving diversity necessities elevate worldwide carbon rights empowerment. Pursue these aspirations leverage, accessibility UNICEF, reduce child mortality collaborative cities safeguards. Informal economies non-partisan; evolution transformative climate change local benefit.</p>

						<a href="#" class="button button-rounded button-reveal tright button-xlarge topmargin-sm"><i class="icon-angle-right"></i><span>Create a Package</span></a>

					</div>
				</div>

			</div>

		</section><!-- #content end -->
@endsection

@section('fooder_javascript')
	<script type="text/javascript">
		$(document).ready(function(){
			var $container = $('#portfolio');
			$container.isotope();
			$(window).resize(function() {
				$container.isotope('layout');
			});
		});
	</script>
	<script>
		$(function() {
			$('.travel-date-group').datepicker({
				autoclose: true,
				startDate: "today"
			});
		});
	</script>
@endsection


