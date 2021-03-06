<!-- 
	CSS:
		<link rel="stylesheet" href="css/onepage.css" type="text/css" />
-->

<footer id="footer" class="dark noborder">
	<div class="container center">
		<div class="footer-widgets-wrap">
			<div class="row divcenter clearfix">
				<div class="col-md-4">
					<div class="widget clearfix">
						<h4>Site Links</h4>
						<ul class="list-unstyled footer-site-links nobottommargin">
							<li><a href="#" data-scrollto="#wrapper" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">Top</a></li>
							<li><a href="aboutus.php" data-scrollto="#section-about" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">About Us</a></li>
							<li><a href="#" data-scrollto="#section-works" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">Works</a></li>
							<li><a href="#" data-scrollto="#section-services" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">Services</a></li>
							<li><a href="#" data-scrollto="#section-blog" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">Blog</a></li>
							<li><a href="#" data-scrollto="#section-contact" data-easing="easeInOutExpo" data-speed="1250" data-offset="70">Contact</a></li>
						</ul>
					</div>
				</div>
			<div class="col-md-4">
				<div class="widget clearfix">
					<h4>Subscribe</h4>
						<div id="widget-subscribe-form-result" data-notify-type="success" data-notify-msg=""></div>
						<form id="widget-subscribe-form" action="../include/subscribe.php" role="form" method="post" class="nobottommargin">
							<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control input-lg not-dark required email" placeholder="Your Email Address">
							<button class="button button-border button-circle button-light topmargin-sm" type="submit">Subscribe Now</button>
						</form>
						<script type="text/javascript">
							$("#widget-subscribe-form").validate({
								submitHandler: function(form) {
									$(form).find('.input-group-addon').find('.icon-email2').removeClass('icon-email2').addClass('icon-line-loader icon-spin');
									$(form).ajaxSubmit({
										target: '#widget-subscribe-form-result',
										success: function() {
											$(form).find('.input-group-addon').find('.icon-line-loader').removeClass('icon-line-loader icon-spin').addClass('icon-email2');
											$('#widget-subscribe-form').find('.form-control').val('');
											$('#widget-subscribe-form-result').attr('data-notify-msg', $('#widget-subscribe-form-result').html()).html('');
											SEMICOLON.widget.notifications($('#widget-subscribe-form-result'));
										}
									});
								}
							});
						</script>
				</div>
			</div>
			<div class="col-md-4">
				<div class="widget clearfix">
					<h4>Contact</h4>
					<p class="lead">795 Folsom Ave, Suite 600<br>San Francisco, CA 94107</p>
					<div class="center topmargin-sm">
						<a href="#" class="social-icon inline-block noborder si-small si-facebook" title="Facebook">
							<i class="icon-facebook"></i>
							<i class="icon-facebook"></i>
						</a>
						<a href="#" class="social-icon inline-block noborder si-small si-twitter" title="Twitter">
							<i class="icon-twitter"></i>
							<i class="icon-twitter"></i>
						</a>
						<a href="#" class="social-icon inline-block noborder si-small si-github" title="Github">
							<i class="icon-github"></i>
							<i class="icon-github"></i>
						</a>
						<a href="#" class="social-icon inline-block noborder si-small si-pinterest" title="Pinterest">
							<i class="icon-pinterest"></i>
							<i class="icon-pinterest"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="copyrights">
	<div class="container center clearfix">
		Copyright Canvas 2015 | All Rights Reserved
	</div>
</div>
</footer>