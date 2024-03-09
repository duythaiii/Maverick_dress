@extends('master')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;800&display=swap');
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
<form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
    @csrf

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
        <tr>
            <div class="form-group">
                <label>Product name</label>
                <input type="text" class="form-control" name="name" value ="{{old('name')}}" placeholder="Please enter your product"/>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" name="price" value ="{{old('price')}}" placeholder="Please enter your price">
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <label>Introduce</label>
                <textarea type="text" class="form-control" name="introduce" placeholder="Please enter your introduce">{{old('introduce')}}</textarea>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <label>Content</label>
                <textarea type="text" class="form-control" name="content" placeholder="Please enter your content" >{{old('content')}}</textarea>
            </div>
        </tr>

        <tr>
            <div class="form-group">
                <label>Category </label>
                <select class="form-control" name = "id_category" padding="20px">
                        {{OptionSelects($categorys,0)}}
                </select>
            </div>
        </tr>

        <tr>
            <label>Size</label>
            <br>
            <div style="text-align: center; padding:20px">
                @foreach($sizes as $size)
                <input type="checkbox" name="size[]" value="{{$size->size}}">{{$size->size}}
                @endforeach
            </div>

        </tr>

        <tr>
            <div class="form-group"  id="addimg">
                <label>Images</label>
                <input type="file" class="form-control" name="src[]">
            </div>
            <div class="card-footer" style="text-align: center">
                <input type="button" class="btn btn-info" value="ADD" id="addmore">
            </div>
        </tr>
        <tr>
            <div class="card-footer" style="text-align: center; padding: 20px">
                <button type="submit" class="btn btn-info">Create Product</button>
            </div>
        </tr>
    </table>


    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/myscript.js') }}"></script>
    
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    {{-- <script src="{{asset('assets/fonts/ckeditor/ckeditor.js')}}"></script> --}}
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace('introduce',{
            filebrowserUploadUrl:'{{ route("admin.product.upload",["_token" => csrf_token()]) }}',
            filebrowserUploadMethod: "form"
        })
        CKEDITOR.replace('content',{
            filebrowserUploadUrl:'{{ route("admin.product.upload",["_token" => csrf_token()]) }}',
            filebrowserUploadMethod: "form"
        });
    </script>

</form>
@endsection
