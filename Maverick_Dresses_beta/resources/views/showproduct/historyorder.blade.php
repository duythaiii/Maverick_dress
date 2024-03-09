<!Doctype html>
<html lang="zxx">
<head>
    @include('blockhome.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('nhung/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('nhung/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('nhung/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('nhung/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
</head>

<body>

    @include('blockhome.header_part')

<table cellspacing=0 cellpadding=8 class="table table-bordered table-striped" id="example1" style="text-align:center;top:100px">
    <thead>   
        <tr>
            <th>STT</th>
            <th>ID_Order</th>
            <th>Total</th>
            <th>Create_At</th>
            <th>Status</th>
            <th>Select</th>
            <th>Payment</th>
            <th>Detail</th>
        </tr>
    </thead>

    <tbody>
        @forelse($orders as $order)
        @if($order->status != 'ready')
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
                {{$order->code_order}}
            </td>
            <td>{{number_format(($order->total_price),0,'','.')}} ₫</td>
            <td>{{date('d-m-Y | H:m:s',strtotime($order->updated_at))}}</td>
            <td>@php 
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
        @endphp</td>
        <td>
            @if($order->status == 3  || $order->status == 5 || $order->status == 6 || $order->status == 7)
               <input type="submit" style="border:0px;" style="background-color:rgba(255, 255, 255, 0)" disabled value="Cancel" />
            @elseif($order->status == 4)
                <form action="{{route('user.history.returns',['id'=>$order->id])}}" method="post"> @csrf<input style="border:0px;color:rgb(255, 4, 121);background-color:rgba(255, 255, 255, 0)" type="submit" name="status" value="Return" /></form>
            @else
                <form action="{{route('user.history.cancal_cart',['id'=>$order->id])}}" method="post"> @csrf<input type="submit" style="border:0px;color:rgb(255, 0, 0);background-color:rgba(255, 255, 255, 0)" name="status" value="Cancel" /></form>
            @endif</td>
            <td>@if($order->payment==2)
                <strong style="color:rgb(0, 255, 191);">Paid</strong>
                @else
                <strong style="color:rgb(255, 0, 0)">Unpaid</strong>
            @endif</td>
            <td><a href="{{route('user.history.history_detail',['id'=>$order->id])}}">Views</a></td>
        </tr>
        @endif
        @empty
            <tr>
                <td colpan="7" style='position:absolute; top:50%; left:40%;font-size:30px'>No data</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="footer-dark" style="margin-top:25%">
    <footer>
        <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-3 item">
                <h3>About</h3>
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('shopingcart')}}">Clothes</a></li>
                    <li><a href="{{route('historyorder')}}">History</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                </ul>
              </div>
                <div class="col-sm-6 col-md-3 item">
                  <h3>Co-Founder</h3>
                    <ul>
                        <li><a href="#">Phạm Phúc Lợi</a></li>
                        <li><a href="#">Trần Trung Quân</a></li>
                        <li><a href="#">Phạm Duy thái</a></li>
                        <li><a href="#">Kiều Minh Kha</a></li>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>Explore Maverick-Dresses</h3>
                    <p style="color: white">If you are a hot girl, you must choose the dresses that is very HOT. From the material to the shape, it is easy to make the women super-cute. Gives you the confidence that attracts all eyes.</p>
                </div>
                <div class="col item social">
                  <a href="https://www.facebook.com/"><i class="icon ion-social-facebook" title="facebook"></i></a>
                  <a href="https://twitter.com/"><i class="icon ion-social-twitter" title="áp con chim xanh"></i></a>
                  <a href="{{route('historyorder')}}"><i class="icon ion-social-snapchat" title="áp con ma"></i></a>
                  <a href="{{route('contact')}}"><i class="icon ion-social-instagram" title="instagram"></i></a>
                </div>
            </div>
            {{-- <p class="copyright">Company Name © 2018</p> --}}
        </div>
    </footer>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-dataTables.js') }}"></script>
<script src="{{ asset('assets/js/myscript.js') }}"></script>

<script src="{{ asset('nhung/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-buttons/js/buttons.print.min.js}')}}"></script>
<script src="{{ asset('nhung/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>  


    
</body>

</html>
