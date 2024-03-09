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

<table >
    <form action="{{route('admin.category.store')}}" method="post" type="multipart/form-group">
        @csrf
        <tr>
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="name" value ="{{old('name')}}" placeholder="Please enter your category">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <label>Page type</label>
                <select class="form-control" name = "parent">
                    <option value="0" style="text-align: center">--- ROOT ---</option>
                    {{OptionSelects($categorys,0)}}
                </select>
            </div>
        </tr>
        <tr>
            <div class="card-footer"  style="text-align: center; padding: 20px">
                <button type="submit" class="btn btn-info">Create</button>
            </div>
        </tr>
    </form>
</table>
@endsection