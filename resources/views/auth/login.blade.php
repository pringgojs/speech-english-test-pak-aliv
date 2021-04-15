<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>{{env('APP_NAME')}} ​</title>
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
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row" style="background: #fff; box-shadow: 0px 0px 15px 2px rgba(222, 222, 222, 0.5);border-radius: 5px;">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign in</h3>
										</div>	
										<div class="form-wrap">
                                            <form role="form" method="POST" action="{{ url('/login') }}">
                                                {{ csrf_field() }}
												<div class="form-group">
													<label class="control-label mb-10" for="username">Username or Email</label>
													<input type="text" class="form-control" name="username" required value="{{old('username')}}" id="username" placeholder="Username or Email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password">Password</label>
													<div class="clearfix"></div>
													<input type="password" class="form-control" name="password" required="" id="password" placeholder="Enter password">
												</div>
												
												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="remember" name="remember" type="checkbox">
														<label for="remember"> Keep me logged in</label>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-sm">sign in</button>
													<a href="{{url('register')}}" type="button" class="btn btn-default btn-sm">register</a>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
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
