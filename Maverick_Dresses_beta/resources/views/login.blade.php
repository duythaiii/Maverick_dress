<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;800&display=swap');
	*{
		font-family: Poppins;
	}

	.register{
		position: relative;
		right: 150px;
		font-size: 20px;
		top: 17px;

	}

	.forgot_password{
		position: relative;
		left: 100px;
		font-size: 20px;
	}
</style>

<link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
<link rel="stylesheet" href="{{asset('assets/core.css')}}" />
<link rel="stylesheet" href="{{asset('assets/theme-df.css')}}" />
<title>Login Member</title>
<link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
<div class="login-wrap">
	<div class="login-html">
	<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"> </label>
		<div class="login-form">
			<form action="{{route('postlogin')}}" method="post">
				@csrf
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">Email</label>
						<input id="user" type="text" class="input" value ="{{old('email')}}" name="email">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" type="password" class="input" data-type="password" name = "password">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign In">
					</div>
					@if($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					@if (Session::has('error'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<strong>{{ Session::get('error') }}</strong>
					</div>
					@endif 
				@if (Session::has('success'))
					<div class="alert alert-primary alert-dismissible" role="alert">
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						<strong>{{ Session::get('success') }}</strong>
					</div>
				@endif
					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="{{route('registers')}}" class="register">Register</a>
					</div>
					<div class="foot-lnk">
						<a href="{{route('forget_pass')}}" class="forgot_password">Forgot password</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>