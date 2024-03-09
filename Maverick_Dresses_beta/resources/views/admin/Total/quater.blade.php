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
<div style="text-align: center; background-color:white;box-sizing:border-box;width: 400px;margin: auto;border-radius:10px;box-shadow:5px 2px 2px 2px">
    <h1 style="font-size:40px; color:rgb(0, 0, 251);">{{$year}}</h1></div>
<div >
    <form action="{{route('admin.total.post_quater')}}" method="post">
    @csrf
    <table class="table-bordered" >
        <tr><td>Year</td><td><input type="number" class="form-control" name="year" ></td></tr>
        <tr><td>Quater</td><td><input type="number" class="form-control" name="quater" ></td></tr>
        <tr><td colspan="2" class="font-center"><button  type="submit">Submit</button></td></tr>
    </table>
    </form></div>
        <table cellpadding=8 class="table-bordered table-striped" id="example1">
        <thead>   
            <tr>
                <th class="font-center">STT</th>
                <th class="font-center">User Name</th>
                <th class="font-center">Code Orders</th>
                <th class="font-center">Total Amount</th>
                <th class="font-center">Status</th>
                <th class="font-center">Updated_at</th>

            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @if($order->status != 'ready')
                <tr>
                    <td class="font-center">{{$loop->iteration}}</td>
                    <td class="font-center">@foreach($users as $user)
                            @if($user->id == $order->id_user)
                                {{$user->name}}
                            @endif
                        @endforeach
                    </td>
                    <td class="font-center">
                        {{$order->code_order}}
                    </td>
                    <td class="font-center">{{number_format(($order->total_price),0,'','.')}}<span style="color:red">₫
                    </span></td>
                        <td class="font-center">@php 
                            if($order->status == 1 ){
                                echo '<strong style="color:rgb(60, 255, 0);">Wait for confirmation</strong>';
                            }elseif($order->status ==2){
                                echo '<strong style="color:rgb(229, 255, 0)">Confirmed</strong>';
                            }elseif($order->status ==3){
                                echo '<strong style="color:rgb(0, 204, 255)">Delivery in progress</strong>';
                            }elseif($order->status == 4){
                                echo '<strong style="color:rgb(0, 4, 252)">Delivery successful</strong>';
                            }elseif($order->status == 6){
                                echo '<strong style="color:rgb(181, 0, 252)">Waiting to check the goods</strong>';
                            }elseif($order->status == 7){
                                echo '<strong style="color:rgb(252, 0, 105)">Returns Successfully</strong>';
                            }else{
                                echo '<strong style="color:rgb(255, 0, 0)">Cancel</strong>';
                            }
                    @endphp
                    </td>
                    <td class="font-center">{{date('d-m-Y | H:m:s',strtotime($order->updated_at))}}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div  class="form-control">
        <div style="font-size:16px;">
            <table >
                <tr>
                    <td>
                        <b>Total order: </b>
                    </td>
                    <td>{{$status4+$status5+$status+$status7}}</td>
                </tr>
                <tr>
                    <td>
                        <b>Delivery successful: </b>
                    </td>
                    <td>{{$status4}}</td>
                </tr>
                <tr>
                    <td>
                        <b>Order canceled: </b>
                    </td>
                    <td>{{$status5}}</td>
                </tr>
                <tr>
                    <td>
                        <b>Returned orders: </b>
                    </td>
                    <td>{{$status7}}</td>
                </tr>
                <tr>
                    <td>
                        <b>Other: </b>
                    </td>
                    <td>{{$status}}</td>
                </tr>
                <tr>
                    <td>
                        <strong style="color:rgb(0, 42, 255);">
                            Ship: </strong>
                    </td>
                    <td>{{number_format(($ship),0,'','.')}}₫</td>
                </tr>
                <tr>
                    <td>
                        <strong style="color:rgb(0, 42, 255);">
                            Total: </strong>
                    </td>
                    <td>{{number_format(($total-$ship),0,'','.')}}₫</td>
                </tr>
                <tr>
                    <td>
                        <p style="color:rgb(0, 42, 255);">
                            Average Per Month: 
                        </p>
                    </td>
                    <td>{{number_format(($total/30),0,'','.')}}₫</td>
                </tr>
            </table>
            </div>
    </div>
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