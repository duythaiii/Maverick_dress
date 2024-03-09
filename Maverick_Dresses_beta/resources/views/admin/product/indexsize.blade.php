<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="./fontawesome-free-6.0.0-web/css/all.css">

@extends('master')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif

<div class="card-body">
    <form  enctype="multipart/form-data" width="100%">
        <table style=" border:1px; " width="100%" class="table table-bordered">
                <tr>
                    <th class="font-center" width='200px'>STT</th>
                    <th class="font-center" width='800px'>Size</th>
                    <th class="font-center" width='800px'>Delete</th>
                </tr>
            @forelse($sizes as $size)
                <tr>
                    <td class="font-center">{{ $loop->iteration }}</td>
                    <td class="font-center" >{{ $size->size }}</td>
                    <td class="font-center"><a onClick="return confirmDelete()" href="{{route('admin.product.deletesize', ['id' => $size->id] )}}"><i class="fa-solid fa-trash" style="font-size:25px"></i></a></td>
                </tr>

                @empty
                    <tr>
                        <td class="font-center" colspan=3>No data</td>
                    </tr>
                @endforelse
        </table>
    </form>
    <div class="col-lg-12">
        <div class="pageination">
            <div class="text-center">
                {{ $sizes->links() }}
            </div>  
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/myscript.js') }}"></script>
</div>
@endsection