<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm the code</title>
    <link rel="icon" href="{{asset('assets/img/logo.jpg')}}">
    <style type="text/css">
        .error{
            color: red;
        }
    </style>
</head>
<body>
    @php
   $id=5;
    @endphp
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Enter the confirmation code</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
            <div class="login-form">
                <form action="{{route('fillConfirmCode')}}" method="post">
                @csrf
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label" >Please check your email and enter the confirmation code here: </label>
                            <input id="user" class="input" name="confirm_code" type="text" id="email">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Submit" >
                        </div>
                        {{-- @if ($errors->any())
                            <label for="user" class="label">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error">{{ $error }}</li>
                                    @endforeach
                                </ul> --}}
                            @if (Session::get('confirm_code_error'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('confirm_code_error') }}</strong>
                                </div>
                            @endif
                            @if (Session::get('confirm_code_error_null'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('confirm_code_error_null') }}</strong>
                            </div>
                            @endif
                            {{-- </label>
                        @endif --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
