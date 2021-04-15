<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>PERTAMINA - TBBM TANJUNG WANGI GROUP ​</title>
		<meta name="description" content="Selamat datang di Website resmi TBBM TANJUNG WANGI GROUP" />
		<meta name="keywords" content="TBBM TANJUNG WANGI GROUP" />
		<meta name="author" content="Pringgo Juni Saputro | odyinggo@gmail.com"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}" />
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/all.css')}}" />
		<style>
		body {
			
		}
		</style>
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="#">
						<img class="brand-img mr-10" style="height:50px; width: auto" src="{{asset('dist/img/pertamina.png')}}" alt="brand"/>
						<span class="brand-text"></span>
					</a>
				</div>
				
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page" style="background-image: url('{{asset('dist/img/bg-tbbm-wangi.jpeg')}}') !important;background-repeat: no-repeat;
  background-size: 100%;">
				<div class="container-fluid">
                    
                    <div class="container mt-80">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Form Register</div>
                                    <div class="panel-body">
                                            <div class="alert alert-success">Petunjuk: 
                                                <p>1. Langkapi semua form yang ada dibawah ini kemudian klik Tombol Register</p>
                                                <p>2. Setelah data tersimpan, status akun Anda menunggu persetujuan dari Operator.</p>
                                                <p>3. Setelah Operator menyetujui akun Anda, Anda akan menerima email pemberitahuan.</p>
                                                <p>4. Anda sudah bisa mengakses aplikasi.</p>
                                            </div>
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Nama Perusahaan</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">Alamat Email</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-4 control-label">Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
        <script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/all.js') }}"></script>
		<script>
		$('#username').select2();
		</script>
	</body>
</html>

