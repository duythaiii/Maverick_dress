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
<div class="card-body">
    <table class="table table-bordered" style="text-align:center; font_size:20px;" >
        <tr>
            <th style="width:20%">User name</th>
            <th style="width:30%">Address</th>
            <th style="width:1000px">Phone</th>
            <th style="width:30%">Email</th>
        </tr>
        <tr>
            <td>{{$users->name}}</td>
            <td>{{$orders->locationOrder}}</td>
            <td>{{$users->phone}}</td>
            <td>{{$users->email}}</td>
        </tr>
    </table>
</div>


        <table cellpadding=8 class="table-bordered table-striped" id="example1" style="text-align:center">
            <thead>   
                <tr>
                    <th>STT</th>
                    <th>Name Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Payment</th>
                    <th>Size</th>
                </tr>
            </thead>
        
            <tbody>
                @forelse($order_details as $order_detail)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @php
                            foreach($product_sizes as $product_size){
                                if($order_detail->id_product_size == $product_size->id){
                                    foreach($products as $product){
                                        if($product_size->id_product == $product->id)
                                            echo $product->name;
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td>
                        @php
                            foreach($product_sizes as $product_size){
                                if($order_detail->id_product_size == $product_size->id){
                                    foreach($products as $product){
                                        if($product_size->id_product == $product->id)
                                            echo number_format(($product->price),0,'','.').'<span style="color:red">₫</span>';
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td>{{$order_detail->quantity}}</td>
                    <td>@if($orders->payment==2)
                        <strong style="color:rgb(0, 255, 191);">Online Payment</strong>
                        @else
                        <strong style="color:rgb(255, 0, 0)">Immidiate</strong>
                    @endif</td>
        
                    <td>
                        @php
                            foreach($product_sizes as $product_size){
                                if($order_detail->id_product_size == $product_size->id){
                                    foreach($products as $product){
                                        foreach($sizes as $size){
                                            if($product_size->id_size == $size->id && $product_size->id_product == $product->id){
                                                echo $size->size;
                                            }
                                        }
                                    }
                                }
                            }
                        @endphp
                    </td>
                </tr>
                    @empty
                    <tr>
                        <td colspan="5" style='position:absolute; top:50%; left:40%;font-size:30px'>No data</td>
                    </tr>
                @endforelse
            </tbody>
    </table>
    
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

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