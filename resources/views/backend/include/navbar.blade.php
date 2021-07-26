<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="mobile-only-brand pull-left">
		<div class="nav-header pull-left">
			<div class="logo-wrap">
				<a href="{{url('/')}}">
					<img class="brand-img" style="height:30px; width: auto" src="{{asset(setting('logo_sidebar'))}}" alt="brand"/>
					<span class="brand-text">Speech</span>
				</a>
			</div>
		</div>	
		<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
		{{-- <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a> --}}
		<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
		{{-- <form id="search_form" role="search" class="top-nav-search collapse pull-left">
			<div class="input-group">
				<input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
				<span class="input-group-btn">
				<button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
				</span>
			</div>
		</form> --}}
	</div>
	<div id="mobile_only_nav" class="mobile-only-nav pull-right">
		<ul class="nav navbar-right top-nav pull-right">
			@role('administrator')
			<li class="dropdown alert-drp" id="notif">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
						class="zmdi zmdi-notifications top-nav-icon"></i></a>
				<ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
					<li>
						<div class="notification-box-head-wrap">
							<span class="notification-box-head pull-left inline-block">notifications</span>
							<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> 
							</a>
							<div class="clearfix"></div>
							<hr class="light-grey-hr ma-0">
						</div>
					</li>
					<li>
						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 59px;">
							<div class="streamline message-nicescroll-bar" style="overflow: hidden; width: auto; height: 59px;">
								<div class="alert alert-info">Tidak ada notifikasi</div>
							</div>
						</div>
					</li>
				</ul>
			</li>

			<li class="dropdown auth-drp">
				<a href="#" onclick="playAudio()" id="img-profile" class="dropdown-toggle pr-0" data-toggle="dropdown" aria-expanded="true"><img src="{{auth()->user()->photo ? asset(auth()->user()->photo) : asset('dist/img/user1.png')}}" alt="user_auth" class="user-auth-img img-circle"><span class="user-online-status"></span></a>
				<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
					<li>
						<a href="{{url('profile')}}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
					</li>
				</ul>
			</li>
			@endrole

		</ul>
	</div>	
</nav>
<audio id="audioID"> <source src="{{asset('whatsapp_doraemon.mp3')}}" muted="muted" type="audio/mp3"></audio>
@push('scripts')

@endpush