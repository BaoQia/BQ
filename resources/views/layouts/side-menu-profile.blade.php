<div id="side-navigation">
    <div class="col_one_fourth nobottommargin">
		<div class="row bottommargin-sm">
			<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="text-align:center">
				<div class="row">
					<img src="{{ url(LaravelLocalization::getCurrentLocale().'/profile/avatar') }}" class="img-circle bq-side-menu-profile-img" alt="">
				</div>
				<div class="row">
					<a id="changeprofilepicture" href="{{ url(LaravelLocalization::getCurrentLocale().'/updateavatar') }}">{{ trans('messages.updateProfilePicture') }}</a>
				</div>
			</div>
		</div>
        <ul class="sidenav bq-side-menu">
        	<li id="dashboard">
				<a href="dashboard.php">
					<i class="icon-dashboard"></i>
					Dashboard
				</a>
			</li> <!-- add class 'ui-tabs-active' for active menu item -->
			<li id="profile">
				<a href="{{ url(LaravelLocalization::getCurrentLocale().'/profile') }}">
					<i class="icon-user2"></i>
					{{ trans('messages.profile') }}
				</a>
			</li> <!-- add class 'ui-tabs-active' for active menu item -->
            <li id="changepassword">
				<a href="{{ url(LaravelLocalization::getCurrentLocale().'/changepassword') }}">
					<i class="icon-key"></i>
				  {{ trans('messages.changePassword') }}
				</a>
			</li>
			<li id="verification">
				<a href="{{ url(LaravelLocalization::getCurrentLocale().'/verification') }}">
					<i class="icon-ok"></i>
					Verification
				</a>
			</li>
			<li id="mytrip">
				<a href="my-trip.php">
					<i class="icon-map-marker"></i>
					My Trip
				</a>
			</li>
			<li id="mylisting">
				<a href="my-listing.php">
					<i class="icon-list2"></i>
					My List
				</a>
			</li>
			<li id="mycars">
				<a href="{{ url(LaravelLocalization::getCurrentLocale().'/mycars') }}">
					<i class="icon-truck"></i>
					 {{ trans('messages.myCars') }}
				</a>
			</li>
            <li id="reviews">
				<a href="reviews-v2.php">
                    <span class="badge pull-right">2</span>
					<i class="icon-bubble"></i>
					Reviews
				</a>
			</li>
            <li id="inbox">
				<a href="inbox.php">
                    <span class="badge pull-right">5</span>
					<i class="icon-mail"></i>
					Inbox
				</a>
			</li>

        </ul>
    </div>
<div>