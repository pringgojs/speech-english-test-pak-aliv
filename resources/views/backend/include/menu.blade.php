
        <div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				@role('guest')
				<?php $type = \Input::get('type') ? :'bunkerfee';?>
				<li>
					<a @if(\Request::segment(2) == 'bunker-fee' && $type == 'bunkerfee') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-bunker-fee"><div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Bunker Fee</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-bunker-fee" class="collapse @if(\Request::segment(2) == 'bunker-fee'  && $type == 'bunkerfee') in @endif  collapse-level-1">
						<li>
							<a href="{{url('guest/bunker-fee/create?type=bunkerfee')}}">Buat Baru</a>
						</li>
						<li>
							<a href="{{url('guest/bunker-fee?type=bunkerfee')}}">Data</a>
						</li>
					</ul>
				</li>

				<li>
					<a @if(\Request::segment(2) == 'bunker-fee' && $type == 'backloading') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-backloading"><div class="pull-left"><i class="fa fa-refresh mr-20"></i><span class="right-nav-text">Backloading</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-backloading" class="collapse @if(\Request::segment(2) == 'bunker-fee'  && $type == 'backloading') in @endif  collapse-level-1">
						<li>
							<a href="{{url('guest/bunker-fee/create?type=backloading')}}">Buat Baru</a>
						</li>
						<li>
							<a href="{{url('guest/bunker-fee?type=backloading')}}">Data</a>
						</li>
					</ul>
				</li>

				<li>
					<a @if(\Request::segment(2) == 'customer') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-customer"><div class="pull-left"><i class="fa fa-user mr-20"></i><span class="right-nav-text">Customer</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-customer" class="collapse @if(\Request::segment(2) == 'customer'  && $type == 'customer') in @endif  collapse-level-1">
						<li>
							<a href="{{url('guest/customer/create')}}">Buat Baru</a>
						</li>
						<li>
							<a href="{{url('guest/customer')}}">Data</a>
						</li>
					</ul>
				</li>
				@endrole
				@role('administrator')
				<li>
					<a @if(\Request::segment(1) == '') class="active" @endif  href="{{url('/')}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Beranda</span></div><div class="clearfix"></div></a>
				</li>
				
				{{-- @if(access_is_allowed_to_view('menu.ownuse')) --}}
				<li>
					<a @if(\Request::segment(1) == 'ownuse') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-ownuse"><div class="pull-left"><i class="zmdi zmdi-chart-donut mr-20"></i><span class="right-nav-text">Ownuse</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-ownuse" class="collapse @if(\Request::segment(1) == 'ownuse') in @endif  collapse-level-1">
						@if(access_is_allowed_to_view('create.ownuse'))
						<li>
							<a href="{{url('ownuse/create')}}">Buat Baru</a>
						</li>
						@if(access_is_allowed_to_view('read.ownuse'))
						@endif
						<li>
							<a href="{{url('ownuse')}}">Data</a>
						</li>
						@endif
					</ul>
				</li>
				{{-- @endif --}}
				{{-- @if(access_is_allowed_to_view('menu.bunker.umum')) --}}
				<li>
					<a @if(\Request::segment(1) == 'bunker-umum') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#menu-bunker-umum"><div class="pull-left"><i class="fa fa-cubes mr-20"></i><span class="right-nav-text">Bunker Umum </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="menu-bunker-umum" class="collapse @if(\Request::segment(1) == 'bunker-umum') in @endif  collapse-level-1">
						@if(access_is_allowed_to_view('create.bunker.umum'))
						<li>
							<a href="{{url('bunker-umum/create')}}">Buat Baru</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.bunker.umum'))
						<li>
							<a href="{{url('bunker-umum')}}">Data</a>
						</li>
						@endif
					</ul>
				</li>
				{{-- @endif --}}
				{{-- @if(access_is_allowed_to_view('menu.loading.pln')) --}}
				<li>
					<a @if(\Request::segment(1) == 'loading-pln') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#loading-pln-menu"><div class="pull-left"><i class="fa fa-first-order mr-20"></i><span class="right-nav-text">Loading MFO & Industri </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="loading-pln-menu" class="collapse @if(\Request::segment(1) == 'loading-pln') in @endif  collapse-level-1">
						@if(access_is_allowed_to_view('create.loading.pln'))
						<li>
							<a href="{{url('loading-pln/create')}}">Buat Baru</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.loading.pln'))
						<li>
							<a href="{{url('loading-pln')}}">Data</a>
						</li>
						@endif
					</ul>
				</li>
				{{-- @endif --}}

				{{-- @if(access_is_allowed_to_view('menu.loading.apms')) --}}
				<li>
					<a @if(\Request::segment(1) == 'loading-apms') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#loading-apms-menu"><div class="pull-left"><i class="fa fa-hashtag mr-20"></i><span class="right-nav-text">Loading APMS </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="loading-apms-menu" class="collapse @if(\Request::segment(1) == 'loading-apms') in @endif  collapse-level-1">
						@if(access_is_allowed_to_view('read.loading.apms'))
						<li>
							<a href="{{url('loading-apms/create')}}">Buat Baru</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.loading.apms'))
						<li>
							<a href="{{url('loading-apms')}}">Data</a>
						</li>
						@endif
					</ul>
				</li>
				<li>
					<a @if(\Request::segment(1) == 'laporan') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#laporan-menu"><div class="pull-left"><i class="fa fa-file mr-20"></i><span class="right-nav-text">Laporan </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="laporan-menu" class="collapse @if(\Request::segment(1) == 'laporan') in @endif  collapse-level-1">
						<li>
							<a href="{{url('laporan/ownuse')}}">Ownuse</a>
						</li>
						<li>
							<a href="{{url('laporan/bunker-umum')}}">Bunker Umum</a>
						</li>
						<li>
							<a href="{{url('laporan/loading-pln')}}">Loading MFO & Industri</a>
						</li>
						<li>
							<a href="{{url('laporan/loading-apms')}}">Loading APMS</a>
						</li>
					</ul>
				</li>

				<li>
					<a @if(\Request::segment(1) == 'bunker-fee') class="active" @endif href="{{url('bunker-fee')}}"><div class="pull-left"><i class="fa fa-money  mr-20"></i><span class="right-nav-text">Bunker Fee </span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a @if(\Request::segment(1) == 'rapat') class="active" @endif href="{{url('rapat')}}"><div class="pull-left"><i class="fa fa-group  mr-20"></i><span class="right-nav-text">Rapat P2T </span></div><div class="clearfix"></div></a>
				</li>
				{{-- @endif --}}
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Master</span>
					<i class="zmdi zmdi-more"></i>
				</li>
				@if(access_is_allowed_to_view('read.kapal'))
				<li>
					<a @if(\Request::segment(1)=='kapal' ) class="active" @endif href="{{url('kapal')}}">
						<div class="pull-left"><i class="zmdi zmdi-shopping-basket  mr-20"></i><span class="right-nav-text">Kapal </span></div>
						<div class="clearfix"></div>
					</a>
				</li>
				@endif
				<li>
					<a @if(\Request::segment(1) == 'master') class="active" @endif href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Master Data </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="app_dr" class="collapse @if(\Request::segment(1) == 'master') in @endif  collapse-level-1">
						@if(access_is_allowed_to_view('read.master.produk'))
						<li>
							<a @if(\Request::segment(2) == 'produk') class="active-page" @endif href="{{url('master/produk')}}">Produk</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kategori'))
						<li>
							<a @if(\Request::segment(2) == 'kategori' && \Input::get('tipe') == 'pelaksanaan') class="active-page" @endif href="{{url('master/kategori?tipe=pelaksanaan')}}">Jenis Pelaksanaan</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kategori'))
						<li>
							<a @if(\Request::segment(2) == 'kategori' && \Input::get('tipe') == 'agen_kapal') class="active-page" @endif href="{{url('master/kategori?tipe=agen_kapal')}}">Agen Kapal</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kategori'))
						<li>
							<a @if(\Request::segment(2) == 'kategori' && \Input::get('tipe') == 'jenis_kapal') class="active-page" @endif href="{{url('master/kategori?tipe=jenis_kapal')}}">Jenis Kapal</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kategori'))
						<li>
							<a @if(\Request::segment(2) == 'kategori' && \Input::get('tipe') == 'harga') class="active-page" @endif href="{{url('master/kategori?tipe=harga')}}">Jenis Harga</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kategori'))
						<li>
							<a @if(\Request::segment(2) == 'kategori' && \Input::get('tipe') == 'pemberi_order') class="active-page" @endif href="{{url('master/kategori?tipe=pemberi_order')}}">Pemberi Order</a>
						</li>
						@endif
						@if(access_is_allowed_to_view('read.master.kode.meter'))
						<li>
							<a @if(\Request::segment(2) == 'kode-meter') class="active-page" @endif href="{{url('master/kode-meter')}}">Kode Meter</a>
						</li>
						@endif
						<li>
							<a @if(\Request::segment(2) == 'posisi-dermaga') class="active-page" @endif href="{{url('master/posisi-dermaga')}}">Posisi Deramaga</a>
						</li>
					</ul>
				</li>
				@if(access_is_allowed_to_view('read.user'))
					<li>
						<a @if(\Request::segment(1) == 'user') class="active" @endif href="{{url('user')}}"><div class="pull-left"><i class="fa fa-user  mr-20"></i><span class="right-nav-text">Pengguna </span></div><div class="clearfix"></div></a>
					</li>
				@endif
				@if(access_is_allowed_to_view('read.setting'))<li>
				<li>
					<a @if(\Request::segment(1) == 'setting') class="active" @endif href="{{url('setting')}}"><div class="pull-left"><i class="fa fa-cog  mr-20"></i><span class="right-nav-text">Pengaturan </span></div><div class="clearfix"></div></a>
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
