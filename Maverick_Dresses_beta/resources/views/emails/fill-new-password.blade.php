<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm password</title>
    <link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
    <style type="text/css">
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Confirm password</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
            <div class="login-form">
                <form action="{{route('fillNewPassword',['id' => $id ])}}" method="post">
                @csrf
                    <div class="sign-in-htm">
                        <div class="group">
                            
                            <label for="user" class="label" >Enter your new password: </label>
                            <input id="user" class="input" name="newpassword" type="password" id="email">
                        </div>
                        <div class="group">
                            <label for="user" class="label" >Reconfirm new password: </label>
                            <input id="user" class="input" name="confirmnewpassword" type="password" id="email">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Submit" >
                        </div>
                        @if (Session::get('confirm_new_pass_error'))
                        <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ Session::get('confirm_new_pass_error') }}</strong>
                        </div>
                        @endif

                        @if (Session::get('confirm_pass_error_old_null'))
                        <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ Session::get('confirm_pass_error_old_null') }}</strong>
                        </div>
                        @endif

                        @if (Session::get('confirm_pass_error_new_null'))
                        <div class="alert alert-info alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ Session::get('confirm_pass_error_new_null') }}</strong>
                        </div>
                        @endif

                        
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</body>
</html>
