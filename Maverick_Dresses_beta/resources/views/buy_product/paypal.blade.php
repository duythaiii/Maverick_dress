@extends('home')


<link rel="stylesheet" href="{{ asset('search/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('search/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
{{-- 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script> --}}

@section('content')
<section class="cart_area padding_top">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
            <table class="table">
                <thead>   
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Size</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order_details as $order_detail)
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <tr>
                        <td>
                            <h5>
                                @php
                                    foreach ($product_size_colors as $product_size_color){
                                        if($order_detail->id_product_size == $product_size_color->id){
                                            foreach ($products as $product){
                                                if($product_size_color->id_product ==$product->id ){
                                                    foreach ($data_image as $data_imag){
                                                        if($data_imag->id_product == $product->id){
                                                            $avatar=$data_imag->src;
                                                            $image =asset('images/'.$avatar);
                                                            $htmlx ='<img width="150px" height="100px" src="';
                                                            $htmly='"';
                                                            echo $htmlx.$image.$htmly;
                                                        }
                                                    }   
                                                }
                                            }
                                        }
                                    }
                                @endphp
                            </h5>
                        </td>

                        <td>
                            <div class="media">
                            <div class="media-body">
                                    <p>
                                        @php
                                            foreach ($product_size_colors as $product_size_color){
                                                if($order_detail->id_product_size == $product_size_color->id){
                                                    foreach ($products as $product){
                                                        if($product_size_color->id_product ==$product->id ){
                                                            echo $product->name;
                                                        }
                                                    }
                                                }
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </td>
                            
                        <td>
                            <input class="price_product"type="hidden" value="
                                @php
                                    foreach ($product_size_colors as $product_size_color){
                                        if($order_detail->id_product_size == $product_size_color->id){
                                            foreach ($products as $product){
                                                if($product_size_color->id_product ==$product->id ){
                                                    echo number_format(($product->price),0,'','.');
                                                }
                                            }
                                        }
                                    }
                                @endphp">  
                                @php
                                    foreach ($product_size_colors as $product_size_color){
                                        if($order_detail->id_product_size == $product_size_color->id){
                                            foreach ($products as $product){
                                                if($product_size_color->id_product ==$product->id ){
                                                    echo number_format(($product->price),0,'','.').'<span style="color:red">₫</span>';
                                                }
                                            }
                                        }
                                    }
                                @endphp
                        </td>
                        
                        <td >
                            <h5>
                                <div class="product_count" >
                                    <input name="quantity_cart" class="input-number" type="text" value="@php
                                        foreach ($product_size_colors as $product_size_color){
                                        if($order_detail->id_product_size == $product_size_color->id){
                                            foreach ($products as $product){
                                                if($product_size_color->id_product ==$product->id ){
                                                    echo $order_detail->quantity;
                                                }
                                            }
                                        }
                                    }       
                                    @endphp">
                                </div>
                            </h5>
                        </td>

                        <td>
                            @php 
                            foreach($product_size_colors as $product_size_color){
                                    if($order_detail->id_product_size == $product_size_color->id){
                                        foreach ($size_products as $size_product){
                                            if($product_size_color->id_size == $size_product->id){
                                                echo $size_product->size;
                                            }
                                        }
                                    }
                                }
                            @endphp
                        </td>

                        <td class="total_price_product">   
                        @php 
                            foreach ($product_size_colors as $product_size_color){
                                if($order_detail->id_product_size == $product_size_color->id){
                                    foreach ($products as $product){
                                        if($product_size_color->id_product ==$product->id ){
                                            $total_price = $product->price *$order_detail->quantity;
                                                echo number_format(($total_price),0,'','.').'<span style="color:red">₫</span>';
                                        }
                                    }
                                }
                            }
                        @endphp
                        </td>
                    </tr>
                    </form>
                    @endforeach 
                <tr>
                    <td colspan="3"><h5>The number of products : {{$subtotal}}</h5></td>
                    <td colspan="2"><h5>Shipping fee : 40.000<span style="color:red"> đ</span></h5></td>
                {{-- <td colspan="3"><h4 style="color:red">Total Amount : {{number_format(($total_price_result + 40000),0,'','.')}}đ --}}
                    @php
                        $total_master = $total_price_result+40000;
                        echo '<td colspan="3"><h4 style="color:red">Total Amount: '.number_format(($total_master),0,'','.') .'đ</h4></td>';
                    @endphp
                
                </h4></td>
                </tr>
                </tbody>
            </table>
            <div class="checkout_btn_inner float-right">
                @if (Session::has('error_Null_cart'))
                <strong style="color:red" class="error_Null_cart">{{Session::get('error_Null_cart') }}</strong>
                @endif         
                <a style="display:none" class="btn_1" id="confim"  href="{{route('confirm')}}">Payment</a>
            </div>
                <div>
                    <div id="paypal-button" style="text-align: center;"></div>
                    @php
                        $vnd_to_usd = $total_master/23342;
                    @endphp
                    <input type="hidden" id="vnd_to_usd" value="{{round(($vnd_to_usd),2)}}">
                </div>
            </div>
        </div>
    </section> 

    <div class="footer-dark">
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
                      <a id= "links" href="{{route('historyorder')}}"><i class="icon ion-social-snapchat" title="áp con ma"></i></a>
                      <a href="{{route('contact')}}"><i class="icon ion-social-instagram" title="instagram"></i></a>
                    </div>
                </div>
                {{-- <p class="copyright">Company Name © 2018</p> --}}
            </div>
        </footer>
    </div>
    
    <script type="text/javascript"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    var usd = document.getElementById('vnd_to_usd').value;
    var link = document.getElementById('confim').href;
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
        sandbox: 'ARUBMuubnJLTXGdetq4VUg8oNw8h8_DG7oFgDFdNyg3Db7BD0uIB0P5zf1MO-QCABu13qcygGE0zqdNd',
        production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
        size: 'small',
        color: 'gold',
        shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
            amount: {
                total: `${usd}`,
                currency: 'USD'
            }
            }]
        });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.location.href = link;
        });
        }
    }, '#paypal-button');

</script>



@endsection