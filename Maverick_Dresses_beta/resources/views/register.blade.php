<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Member Registration</title>
<link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
<script src="{{asset('register/js/jquery.min.js')}}"></script>
<!-- Custom Theme files -->
<link href="{{asset('register/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Classy Login form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header start here-->
<div class="header">
	<div class="header-main">
			<h1>Register</h1>
		<div class="header-bottom">
			<div class="header-right w3agile">
				<div class="header-left-bottom agileinfo">
					<form action="{{route('sinup')}}" method="post">
					@csrf
						<input type="text" value ="{{old('name')}}"  placeholder="Please enter your name" name="name"/>

						<input type="text" value ="{{old('email')}}" placeholder="Please enter your email" name="email"/>
					
						<input type="password"  placeholder="Please enter your password" name="password" />
				
						<input type="password"  placeholder="Please enter your password" name="password_confirmtion" />
			
						<input type="text" value ="{{old('address')}}" placeholder="Please enter your address" name="address" />
			
			
							<input type="text" value ="{{old('phone')}}"  placeholder="Please enter your phone" name="phone" />
				
					<div class="remember">
							<select name="gender"  style="background-color:rgba(255, 255, 255, 0); width:100%; text-align:center;
							color:rgb(0, 255, 76); height:40px" > 
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="other">Oder</option>
							</select>
						<div class="forgot">
							<h6><a href="{{route('login')}}">Login</a></h6>
						</div>
					<div class="clear"> </div>
					</div>
					<input type="submit" value="Register">
					@if($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li style="color:red;">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</form>	
					
			</div>
			</div>
			
			</div>
		</div>
</div>
<!--header end here-->

<!--footer end here-->
</body>
</html>