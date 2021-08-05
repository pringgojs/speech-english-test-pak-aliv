
<div class="fixed-sidebar-left">
	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
		<ul class="nav navbar-nav side-nav nicescroll-bar" style="overflow: hidden; width: auto; height: 100%;">
			<li class="navigation-header">
				<span>Main</span>
				<hr>
			</li>
			{{-- @role('administrator') --}}
			<li>
				<a @if(\Request::segment(1)=='' ) class="active" @endif href="{{url('/')}}" data-toggle="collapse"
					data-target="#dashboard_dr">
					<div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div>
					<div class="clearfix"></div>
				</a>
			</li>
			{{-- <li class="navigation-header mt-20">
				<span>master</span>
				<hr>
			</li>
			<li>
				<a @if(\Request::segment(1)=='master' ) class="active" @endif href="javascript:void(0);" data-toggle="collapse"
					data-target="#app_dr">
					<div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Master Data </span>
					</div>
					<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
					<div class="clearfix"></div>
				</a>
				<ul id="app_dr" class="collapse @if(\Request::segment(1) == 'master') in @endif  collapse-level-1">
					@if(access_is_allowed_to_view('read.master.company'))<li>
						<a href="{{url('master/company')}}">Perusahaan</a>
					</li>
					@endif
				</ul>
			</li>
			<li>
				<a @if(\Request::segment(1) == 'user') class="active" @endif href="{{url('user')}}"><div class="pull-left"><i class="fa fa-user  mr-20"></i><span class="right-nav-text">Pengguna </span></div><div class="clearfix"></div></a>
			</li>
			<li class="navigation-header mt-20">
				<span>Report</span>
				<hr/>
			</li>
			<li>
				<a href="javascript:void(0);" data-toggle="collapse" data-target="#report-menu">
					<div class="pull-left"><i class="fa fa-file  mr-20"></i><span class="right-nav-text">Laporan</span>
					</div>
					<div class="pull-right"><i class="ti-angle-down "></i></div>
					<div class="clearfix"></div>
				</a>
				<ul id="report-menu" class="collapse @if(\Request::segment(1) == 'report') in @endif  collapse-level-1">
					@if(access_is_allowed_to_view('read.report.employee'))<li>
					<li>
						<a @if(\Request::segment(1) == 'report' && \Request::segment(1) == 'employee') class="active" @endif href="{{url('report/employee')}}">Pegawai</a>
					</li>
					@endif
					@if(access_is_allowed_to_view('read.report.guest'))<li>
					<li>
						<a @if(\Request::segment(1) == 'report' && \Request::segment(1) == 'guest') class="active" @endif href="{{url('report/guest')}}">Tamu</a>
					</li>
					@endif
				</ul>
			</li> --}}
			<li>
				<a href="{{url('logout')}}" href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<div class="pull-left"><i class="fa fa-lock mr-20"></i><span class="right-nav-text">Logout </span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			{{-- @endrole --}}

			@if(!auth()->user())
			<li>
				<a @if(\Request::segment(1)=='' ) class="active" @endif href="{{url('/')}}" data-toggle="collapse"
					data-target="#dashboard_dr">
					<div class="pull-left"><i class="zmdi zmdi-male-female mr-20"></i><span class="right-nav-text">Tamu</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<li>
				<a @if(\Request::segment(1)=='guestbook' ) class="active" @endif href="{{url('guestbook/data')}}"
					data-toggle="collapse" data-target="#guest">
					<div class="pull-left"><i class="fa fa-file mr-20"></i><span class="right-nav-text">Data Hari Ini</span></div>
					<div class="clearfix"></div>
				</a>
			</li>
			@endif
		</ul>
		<div class="slimScrollBar"
			style="background: rgb(135, 135, 135); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 47px;">
		</div>
		<div class="slimScrollRail"
			style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
		</div>
	</div>
</div>