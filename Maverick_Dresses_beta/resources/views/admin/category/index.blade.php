<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="./fontawesome-free-6.0.0-web/css/all.css">
@extends('master')

@section('content')
@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif 

@if (Session::has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif


    <div class="card-body">
        <table cellpadding=50% style="border:20px; width:100%" class="table table-bordered">
                <tr>
                    <th style="width:660px; text-align:center">Category list</th>
                    <th style="width:300px; text-align:center">Edit</th>
                    <th style="width:300px; text-align:center">Delete</th>
                </tr> 
                <tr>
                    {{recursiveTable($categorys)}}
                </tr>

        </table>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/myscript.js') }}"></script>

    <script type="text/javascript">
        var close = null;

        function close () {
            let close = document.getElementById('close');
            close.addEventListener('click', () => {
            window.close();
        });
        }
        </script>
@endsection

