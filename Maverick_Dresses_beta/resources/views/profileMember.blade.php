<!doctype html>
<html lang="zxx">
<head>
	@include('blockhome.head')
	<style>
		input{
			color:black;
		}
		body{
			color:white;
			font-weight: bold ;
			background-image: url({{asset("assets/img/background-home.jpg")}});
			background-repeat: no-repeat;
			background-size: cover;
			
		}
		#table_1{
			margin: 6% 0px;
		}
		a{
			color:white;
			font-weight: bold ;
		}
		.btn-primary{
			width: 20%;
			margin: 0px 0px 0 300px
		}
		.btn-success{
			font-weight: bold ;
			width: 10%;
			margin: 0 0 0 670px
		}
	</style>
</head>
<body>
    <!--::header part start::-->
    @include('blockhome.header_part')
    <!-- Header part end-->
    <h3>Information</h3>
	<div>
		<form action="{{route('user.profile.updateProfile',['id'=>Auth::user()->id])}}" method="post">
			@csrf
				<table id="table_1" class="table table-striped">
					<tr>
						<td>
							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" name="name" disabled value="{{$email_user}}"/>
							</div>
						</td>
					</tr>

					<tr>
						<td>
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" value="{{$name_user}}" />@if ($errors->any())
								@foreach ($errors->all() as $error)
									<strong style="color: red">{{ $error }}</strong>
								@endforeach						
								@endif
							</div>
						</td>
						
					</tr>

					<tr>
						<td>
							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" name="address"  value="{{$address_user}}" />
							</div>
						</td>
						
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label>Phone</label>
								<input type="text" class="form-control" name="phone"  value="{{$phone_user}}" />
							</div>
						</td>
						
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label>Gender</label>
								<select name="sex" class="form-control">
									<option value="1">Male</option>
									<option value="2">Female</option>
									<option value="3">Oder</option>
								</select>
							</div>
						</td>
					</tr>

					<tr>
						<td>
							<button type="submit" class="btn btn-success">Update</button>
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>	
	<div>	
		<form action="{{route('user.profile.updatePassword',['id'=>Auth::user()->id])}}" method="post">
			@csrf
				<table id="table_2" class="table table-striped">
					<tr>
						<td>
							<div class="form-group">
								<input type="hidden" name="email" class="form-control" value="{{$email_user}}" />
								<span style="color:white;">Current password:</span><input type="password" name="password" class="form-control" /> @if (Session::has('ErrorChangePassword'))
								<strong class="passwordNewNull" style="color:red">{{Session::get('ErrorChangePassword') }}</strong>
								@endif 
								@if (Session::has('successPassword'))
<strong class="passwordNewNull" style="color: green">{{Session::get('successPassword') }}</strong>
								@endif
							</div>
						</td>
					</tr>

					<tr>
						<td>
							<div class="form-group">
								<span style="color:white;">A new password</span>
								<input type="password" name="password_new" class="form-control" />@if (Session::has('passwordNewNull'))
								<strong class="passwordNewNull" style="color:red">{{Session::get('passwordNewNull') }}</strong>
									@endif 
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div>
								<span style="color:white;">Confirm password</span><input type="password" name="confirm_password_new" class="form-control" /> @if (Session::has('ErrorConfirmChangePassword'))
								<strong style="color:red">{{Session::get('ErrorConfirmChangePassword') }}</strong>
								@endif
								@if (Session::has('ConfirmpasswordNewNull'))
								<strong style="color:red">{{Session::get('ConfirmpasswordNewNull') }}</strong>
								@endif
							</div>
						</td>
					</tr>

					<tr>
						<td>
							<button type="submit" class="btn btn-success">Update</button>
						</td>
					</tr>
				</table>
				
			</fieldset>
		</form>
	</div>
		<button type="submit" class="btn btn-primary" id="button_1">
			<a href="{{route('home')}}">Home</a>
		</button>

		<button type="submit" class="btn btn-primary"  id="button_2">
			<a href="{{route('historyorder')}}">Shoping History</a>
		</button>

    {{-- @include('blockhome.alljs') --}}
	@include('blockhome.footer_part')
</body>