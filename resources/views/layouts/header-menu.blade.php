
<nav id="primary-menu" class="default">
	<ul>
		<li><a href="#">
			<div id="header-selected-lang">
				English<span class="caret" style="display: inline-block;"></span>
			</div></a>
			<ul >
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode=> $properties)
				<li><a rel="alternate" hreflang="{{$localeCode}}"
					href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"> {{{$properties['native'] }}} </a></li> 
				@endforeach
			</ul>
		</li>
		<li><a href="#"><div>
					MYR<span class="caret" style="display: inline-block;"></span>
				</div></a>
			<ul>
				<li><a href="#"><div>MYR</div></a></li>
				<li><a href="#"><div>NTD</div></a></li>
				<li><a href="#"><div>USD</div></a></li>
				<li><a href="#"><div>SGD</div></a></li>
			</ul></li>
		<li><a href="#" data-href="#section-how-it-works">
				<div>{{ trans('menus.howItWorks') }}</div>
		</a></li> 
		@if(Auth::check())
		<li class="bq-user-menu-item"><a href="/profile">
				<div class="bq-profile-image-small">
					<img src="{{ url(LaravelLocalization::getCurrentLocale().'/profile/sm-avatar') }}" alt=""
						class='img-circle' />
				</div>
				<div>
					<span class="bq-profile-name-small"> {{ Auth::user()->name }} </span>
					<span class="caret" style="display: inline-block;">
				
				</div>
		</a>
			<ul>
				<li><a href="/auth/logout"><div>{{ trans('menus.logout') }}</div></a></li>
			</ul></li>
		<li class="bq-user-menu-item" style="padding-left: 0px">
			<div class="bq-top-menu-icon" id="bq-top-inbox">
				<a href="inbox.php" id="top-inbox-trigger"><i class="icon-mail"
					style="font-size: 30px"></i><span style="display: block">5</span></a>
			</div>
		</li>
		@else
		<li><a href="/auth/login">
				<div>{{ trans('menus.login') }}</div>
		</a></li>
		<li><a href="/auth/register">
				<div>{{ trans('menus.signUp') }}</div>
		</a></li> 
		@endif
	</ul>
</nav>
