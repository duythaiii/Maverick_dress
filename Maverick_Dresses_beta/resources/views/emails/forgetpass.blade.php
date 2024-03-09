<link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
<style type="text/css">
	.error{
		color: red;
	}
</style>
<title>Forgot password</title>
<link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Forgot password</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		<div class="login-form">
			<form action="{{route('recoverPass')}}" method="post">
			@csrf
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label" >Enter your email:</label>
						<input id="user" class="input" name="confirm_email" type="email" id="email">
					</div>
					<div class="group">
						<input type="submit" class="button" value="submit" >
					</div>
					@if ($errors->any())
						<label for="user" class="label">
							<ul>
								@foreach ($errors->all() as $error)
									<li class="error">{{ $error }}</li>
								@endforeach
							</ul>
						</label>
					@endif
					@if (Session::has('mail_error'))
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>{{ Session::get('mail_error') }}</strong>
						</div>
					@endif 
				</div>
			</form>
		</div>
	</div>
</div>
