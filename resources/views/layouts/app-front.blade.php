<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SPECH TEST</title>
	<meta name="description" content="Simple aplikasi buku tamu. Aplikasi ini dibuat oleh Pringgo Juni Saputro - odyinggo@gmail.com 2019 (www.gramediatech.com);" />
	<meta name="keywords" content="Aplikasi buku tamu, pringgo juni saputro," />
	<meta name="author" content="Pringgo Juni Saputro | odyinggo@gmail.com (www.gramediatech.com)"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
    
    {{-- Css --}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app-admintrees.css')}}" />
	<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/all-admintrees.css')}}" />
	<style>
		.navbar.navbar-inverse {background: #ff6028!important}
	</style>
     @yield('styles')
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper theme-2-active navbar-top-light horizontal-nav">
		<!-- Top Menu Items -->
		@include('backend.include.navbar-admintres')
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		@include('backend.include.menu-admintres')
		<!-- /Left Sidebar Menu -->
		

        <!-- Main Content -->
		<div class="page-wrapper" @if(\Illuminate\Support\Facades\Request::segment(2) == 'form') style="background: #f1f1f1;" @endif>
            <div class="container">
				
				@yield('content')
			</div>
			<div id="app"></div>
			<!-- Footer -->
			<footer class="footer pl-30 pr-30">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							{{-- <p>{{date('Y')}} &copy; Gramediatech.com - Pringgo Juni S (odyinggo@gmail.com)</p> --}}
							<p>Job Interview Simulation</p>
						</div>
						<div class="col-sm-6 text-right">
							{{-- <p>Follow Us</p>
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a> --}}
						</div>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

		<!-- Modal Camera -->
		<div class="row">
			<input type="hidden" id="img-target">
			<input type="hidden" id="input-link">
			<div class="modal fade camera-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg" id="modal-camera"></div>
			</div>
		</div>
    </div>
    <!-- /#wrapper -->
	<script>
		
	</script>
	<!-- JavaScript -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/all.js') }}"></script>
	<script src="{{ asset('webcamjs/webcam.min.js') }}"></script>
	
	<script>
	function openCamera(url, img_target, input_link) {
		$('#img-target').val(img_target);
		$('#input-link').val(input_link);
        $.ajax({
            url: url,
            success: function(result){
                $("#modal-camera").html(result);
            }, error: function(result){
                alert("Failed something went wrong");
            }
        });
    }
	</script>
	
	<script>
		/*Sidebar Collapse Animation*/
		var sidebarNavCollapse = $('.fixed-sidebar-left .side-nav  li .collapse');
		var sidebarNavAnchor = '.fixed-sidebar-left .side-nav  li a';
		$(document).on("click",sidebarNavAnchor,function (e) {
			if ($(this).attr('aria-expanded') === "false")
					$(this).blur();
			$(sidebarNavCollapse).not($(this).parent().parent()).collapse('hide');
		});
		
		/*Panel Remove*/
		$(document).on('click', '.close-panel', function (e) {
			var effect = $(this).data('effect');
				$(this).closest('.panel')[effect]();
			return false;	
		});
		
		/*Accordion js*/
			$(document).on('show.bs.collapse', '.panel-collapse', function (e) {
			$(this).siblings('.panel-heading').addClass('activestate');
		});
		
		$(document).on('hide.bs.collapse', '.panel-collapse', function (e) {
			$(this).siblings('.panel-heading').removeClass('activestate');
		});
		
		/*Sidebar Navigation*/
		$(document).on('click', '#toggle_nav_btn,#open_right_sidebar,#setting_panel_btn', function (e) {
			$(".dropdown.open > .dropdown-toggle").dropdown("toggle");
			return false;
		});
		$(document).on('click', '#toggle_nav_btn', function (e) {
			$wrapper.removeClass('open-right-sidebar open-setting-panel').toggleClass('slide-nav-toggle');
			return false;
		});
	</script>
	<script>
		@for($i=0;$i<=10;$i++)
			@if(session()->has('toaster_message_'.$i))
                $.toast({
                    heading: '{{ session()->get("toaster_title_".$i) }}',
                    text: '{{ session()->get("toaster_message_".$i) }}',
                    position: 'top-right',
                    loaderBg:'#f2b701',
                    icon: '{{ session()->get("toaster_icon_".$i) }}',
                    hideAfter: 3000, 
                    stack: 6
                });
                <?php  session()->forget('toaster_message_'.$i); ?>
            @endif
        @endfor
		
		function notification(title, message) {
			$.toast({
				heading: title,
				text: message,
				position: 'top-right',
				loaderBg:'#ff6849',
				icon: 'info',
				hideAfter: 3000, 
				stack: 6
			});
		}
    </script>
	
	@yield('scripts')
	@stack('scripts')
</body>

</html>
