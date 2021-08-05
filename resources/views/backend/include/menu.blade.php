
        <div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				
				@role('administrator')
				<li>
					<a @if(\Request::segment(1) == '') class="active" @endif  href="{{url('/')}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li>
				
				{{-- @if(access_is_allowed_to_view('menu.ownuse')) --}}
				<li>
					<a @if(\Request::segment(1) == 'student') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-student"><div class="pull-left"><i class="fa fa-group mr-20"></i><span class="right-nav-text">Student</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-student" class="collapse @if(\Request::segment(1) == 'student') in @endif  collapse-level-1">
						{{-- @if(access_is_allowed_to_view('create.student')) --}}
						<li>
							<a href="{{url('student/create')}}">Create New</a>
						</li>
						{{-- @if(access_is_allowed_to_view('read.student'))
						@endif --}}
						<li>
							<a href="{{url('student')}}">Data</a>
						</li>
						{{-- @endif --}}
					</ul>
				</li>
				{{-- @endif --}}
				{{-- @if(access_is_allowed_to_view('menu.bunker.umum')) --}}
				<li>
					<a @if(\Request::segment(1) == 'group') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-group"><div class="pull-left"><i class="fa fa-cubes mr-20"></i><span class="right-nav-text">Group </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-group" class="collapse @if(\Request::segment(1) == 'group') in @endif  collapse-level-1">
						{{-- @if(access_is_allowed_to_view('create.bunker.umum')) --}}
						<li>
							<a href="{{url('group/create')}}">Create New</a>
						</li>
						{{-- @endif
						@if(access_is_allowed_to_view('read.bunker.umum')) --}}
						<li>
							<a href="{{url('group')}}">Data</a>
						</li>
						{{-- @endif --}}
					</ul>
				</li>
				{{-- @endif --}}
				{{-- @if(access_is_allowed_to_view('menu.loading.pln')) --}}
				
				<li>
					<a @if(\Request::segment(1) == 'master') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Master Data </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="app_dr" class="collapse @if(\Request::segment(1) == 'master') in @endif  collapse-level-1">
						{{-- @if(access_is_allowed_to_view('read.master.topic')) --}}
						<li>
							<a @if(\Request::segment(2) == 'topic') class="active-page" @endif href="{{url('master/topic')}}">Topic</a>
						</li>
						{{-- @endif
						@if(access_is_allowed_to_view('read.master.kategori')) --}}
						<li>
							<a @if(\Request::segment(2) == 'question') class="active-page" @endif href="{{url('master/question')}}">Question</a>
						</li>
					</ul>
				</li>
				@if(access_is_allowed_to_view('read.user'))
					<li>
						<a @if(\Request::segment(1) == 'user') class="active" @endif href="{{url('user')}}"><div class="pull-left"><i class="fa fa-user  mr-20"></i><span class="right-nav-text">User </span></div><div class="clearfix"></div></a>
					</li>
				@endif
				@if(access_is_allowed_to_view('read.setting'))<li>
				<li>
					<a @if(\Request::segment(1) == 'setting') class="active" @endif href="{{url('setting')}}"><div class="pull-left"><i class="fa fa-cog  mr-20"></i><span class="right-nav-text">Setting </span></div><div class="clearfix"></div></a>
				</li>
				@endif
			@endrole
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Account</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a @if(\Request::segment(1) == 'profile') class="active" @endif href="{{url('profile')}}"><div class="pull-left"><i class="fa fa-user  mr-20"></i><span class="right-nav-text">Profile </span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="fa fa-lock mr-20"></i><span class="right-nav-text">Logout</span></div><div class="clearfix"></div></a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
				</li>
				
			</ul>
        </div>
