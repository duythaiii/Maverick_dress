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
    

<table class="table table-bordered table-striped" id="example1" style="text-align:center">
    <thead>   
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
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
                                    echo number_format(($product->price),0,'','.').' ₫';
                            }
                        }
                    }
                @endphp
            </td>
            <td>{{$order_detail->quantity}}</td>

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

<div style="padding:150px 0 0 0;">
    <div style="font-size:16px;">
        <table class="table table-striped" >
            <tr>
                <td width="15%">
                    <b>Product price : </b>
                </td>
                <td>{{number_format(($order->total_price-40000),0,'','.')}}₫</td>
            </tr>
            <tr>
                <td>
                    <b>Shipping fee :  </b>
                </td>
                <td>40.000₫</td>
            </tr>
            <tr>
                <td>
                    <b>Total order: </b>
                </td>
                <td>{{number_format(($order->total_price),0,'','.')}}₫</td>
            </tr>
        </table>
        </div>
</div>

<div class="footer-dark" style="padding-top:8%">
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
{{-- dataTable --}}
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