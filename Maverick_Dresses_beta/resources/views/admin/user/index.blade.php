<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

{{-- dataTable --}}
<link rel="stylesheet" href="{{ asset('search/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
<table cellspacing="0" cellpadding="8" class="table-bordered table-striped" id="example1" style="width:100%;padding:5px;text-align:center">
    <thead>
        <tr>
            <th>STT</th>
            <th>Email</th>
            <th>Level</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Adress</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        @forelse($admins as $admin) 
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$admin->email}}</td>
            <td>
                @php
                $link = route('admin.cart.list_order',['id'=>$admin->id]);

                if($admin->id==1){
                    echo '<a class="btn btn-danger ui-draggable-handle"></i>SuperAdmin</a>';
                }else if($admin->level==1){
                        echo '<a class="btn btn-warning ui-draggable-handle"></i>Admin</a>';
                }else {
                    echo '<a class="btn btn-info ui-draggable-handle" href="'.$link.'">Member</a>';
                }
                @endphp
            </td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->gender}}</td>
            <td>{{$admin->phone}}</td>
            <td>{{$admin->address}}</td>
            <td><a href="{{route('admin.user.edit', ['id' => $admin->id] )}}"><i class="fa-regular fa-pen-to-square" style="font-size:25px"></i></a></td>
            <td><a onClick="return confirmDelete()" href="{{route('admin.user.delete', ['id' => $admin->id] )}}"><i class="fa-solid fa-trash" style="font-size:25px"></i></a></td>
        </tr>
        @empty
        <tr>
            <td colpan="9" style='position:absolute; top:50%; left:40%;font-size:30px'>No data</td>
        </tr>
        @endforelse
    </tbody>
</table>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/myscript.js') }}"></script>

    {{-- dataTable --}}
<script src="{{ asset('search/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('search/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('search/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('search/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('search/plugins/datatables-buttons/js/buttons.print.min.js}')}}"></script>
<script src="{{ asset('search/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>   
@endsection

