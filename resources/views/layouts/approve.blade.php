<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>EPM Activity</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand:700" rel="stylesheet">

	<!-- Font Awesome Icon -->
	<link type="text/css" rel="stylesheet" href="{{asset('approval/css/font-awesome.min.css')}}" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{asset('approval/css/style.css')}}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body style="background-image: url('{{asset('dist/img/bg.jpeg')}}') !important;background-repeat: no-repeat;
  background-size: 100%;">
	
	<div id="notfound">
		<div class="notfound">
			<img class="brand-img" style="height:60px; width: auto; padding: 5px; " src="{{asset('dist/img/pertamina.png')}}" alt="brand" />
			<div class="notfound-bg">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<br>
			<h1>{{App\Helpers\ApprovalHelper::checkStatus($data->$status_approval_field, 'excel')}}</h1>
			<h2>Form Number {{$data->number}}</h2>
			<a href="{{url('/')}}">go back</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
