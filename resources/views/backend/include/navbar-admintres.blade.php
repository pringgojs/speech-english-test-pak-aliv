<nav class="navbar @auth navbar-inverse @endauth navbar-fixed-top bg-orange">
	<div class="nav-wrap">
		<div class="mobile-only-brand pull-left">
			<a id="toggle_nav_btn" style="color:#fff" class="toggle-left-nav-btn inline-block ml-20 pull-left"
				href="javascript:void(0);">
				<i class="fa fa-align-left"></i>
			</a>
			<div class="nav-header pull-left text-center  bg-orange" @guest style="width:600px" @endguest>
				<div class="logo-wrap" @guest style="width:600px" @endguest>
					<a href="{{url('/')}}">
						@guest
						<img src="{{asset('dist/img/logo.png')}}" alt="user_auth" style="margin-left:220px;height:150px; width:auto; vertical-align:middle; margin-top:-10px">
						@endguest

						@auth
						{{-- <img class="brand-img" src="{{asset('dist/img/logo-bak.png')}}" style="height:50px; width:auto" alt="brand" /> --}}
						<span class="brand-text" style="color:#fff; font-size:18px; font-weight:bold;">SPEECH RECOGNITION</span>
							
						@endauth
					</a>
				</div>
			</div>
			
			
			{{-- <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
				href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
			<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="ti-more"></i></a>
			<form id="search_form" action="{{url('guestbook/data')}}" role="search" class="top-nav-search collapse pull-left">
				<div class="input-group">
					<input type="text" name="search" class="form-control" placeholder="Search">
					<span class="input-group-btn">
						<button type="button" class="btn  btn-default" data-target="#search_form" data-toggle="collapse"
							aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
					</span>
				</div>
			</form> --}}
			
		</div>
		<div id="mobile_only_nav" class="mobile-only-nav pull-right">
			<ul class="nav navbar-right top-nav pull-right">
				@if(auth()->user())
				<li class="dropdown auth-drp">
					<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown" aria-expanded="true"><img
							src="{{auth()->user()->photo ? asset(auth()->user()->photo) : asset('dist/img/default-user.png')}}"
							alt="user_auth" class="user-auth-img img-circle" style="width:50px"><span class="user-online-status"></span></a>
					<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
						<li>
							<a href="{{url('/logout')}}"
								onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
									class="zmdi zmdi-power"></i><span>Log Out</span></a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}</form>
						</li>
					</ul>
				</li>
				@else
				<li>
					<a href="{{ url('login') }}">
						<button class="btn btn-warning btn-outline" style="color:#fff">LOGIN</button>
					</a>
				</li>
				@endif
			</ul>

		</div>
	</div>
</nav>