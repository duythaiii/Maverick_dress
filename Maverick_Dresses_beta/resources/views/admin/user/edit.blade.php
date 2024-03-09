@extends('master')

<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;800&display=swap');
    div .form-group{
        font-family: Poppins;
        padding-bottom: 10px;
        margin: 7px;
    }

    label {
        margin: 0 0 0 10px;
        font-size: 19px;
    }

    button.btn{
        background-color: rgb(68, 132, 237);
        font-family: Poppins;
        font-size: 18px;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

@section('content')

@if ($errors->any())
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<table>
    <form action="{{route('admin.user.update', ['id' => $edit->id])}}" method="post">
        @csrf
        <tr>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Please enter your email" value= "{{$edit->email}}">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Please enter your name" value= "{{$edit->name}}">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Please enter your password">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Please enter your phone" value= "{{$edit->phone}}">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Please enter your address" value= "{{$edit->address}}">
            </div>
        </tr>
        <tr>
            <div class="form-group">
               
                @php 
                if ( $edit->id != 1 ){
                    echo '<label>Level</label><select class="form-control" name="level">';
                    if($edit->level == 1){
                        echo '<option selected value="1">ADMIN</option><option value="2">MEMBER</option> 
                        </select>';
                    }else{
                        echo  '<option value="1">ADMIN</option><option selected  value="2">MEMBER</option></select>';
                    }
                }
                @endphp
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    @php 
                if ( $edit->gender == 'male' ){
                    echo '<option selected value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>';
                }elseif ($edit->gender == 'female'){
                    echo '<option  value="male">Male</option>
                    <option selected value="female">Female</option>
                    <option value="other">Other</option>';
                }else {
                    echo '<option  value="male">Male</option>
                    <option  value="female">Female</option>
                    <option selected value="other">Other</option>';
                }
                @endphp
                </select>
            </div>
        </tr>
        <tr>
            <div class="card-footer" style="text-align: center; padding: 20px">
                <button type="submit" class="btn btn-info">Edit</button>
            </div>
        </tr>
    </form>
</table>
@endsection