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
@if (Session::has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
    <table cellpadding=8 class="table-bordered table-striped" id="example1">
        <thead>
            <tr>
                <th class="font-center">STT</th>
                <th class="font-center">Images</th>
                <th class="font-center">Product's name</th>
                <th class="font-center">Price</th>
                <th class="font-center">Introduce</th>
                <th class="font-center">Content</th>
                <th class="font-center">Category</th>
                <th class="font-center">Size</th>
                <th class="font-center">Edit</th>
                <th class="font-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="font-center">{{ $loop->iteration }}</td>
                    <td class="font-center">
                            {{-- show hết hình trong mảng --}}
                        @php
                            foreach ($data_image as $img) {
                                if($img->id_product == $product->id) {
                                    $avatar = $img->src;
                                    $image = asset('images/' . $avatar);
                                    echo '<img width="150px" src="' . $image . '">';
                                }
                            }
                        @endphp
                    </td>
                    <td class="font-center">{{ $product->name }}</td>
                    <td class="font-center">{{ number_format(($product->price),0,'','.') }} vnđ</td>
                    <td class="font-center">{{ html_entity_decode(strip_tags( $product->introduce )) }}</td>
                    <td class="font-center">{{ html_entity_decode(strip_tags( $product->content )) }}</td>
                    
                    <td class="font-center">
                        @php
                            foreach ($categorys as $item) {
                                if($product->id_category == $item->id){
                                    echo $item->name;
                                }
                            }
                        @endphp
                    </td>
                    <td class="font-center">
                        @php
                            foreach($product_size_colors as $product_size_color){
                                if($product_size_color->id_product == $product->id){
                                    foreach ($size_products as $size_product){
                                        if($product_size_color->id_size == $size_product->id){
                                            echo '<li>'.$size_product->size.'</li>';
                                            }
                                    }
                                }
                            } 
                        @endphp
                    </td>
                    <td class="font-center"><a href="{{route('admin.product.edit', ['id' => $product->id] )}}"><i class="fa-regular fa-pen-to-square"></i></a></td>
                    <td class="font-center"><a onClick="return confirmDelete()" href="{{route('admin.product.delete', ['id' => $product->id] )}}"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                @empty
                    <tr>
                        <td colpan="10" style='position:absolute; top:50%; left:40%;font-size:30px'>No data</td>
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