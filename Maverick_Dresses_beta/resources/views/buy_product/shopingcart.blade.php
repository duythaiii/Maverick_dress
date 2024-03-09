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
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order_details as $order_detail)
                <form action="{{route('addToCart2',['id'=>$order_detail->id])}}" method="post" enctype="multipart/form-data">
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
                        <td><a href="{{ route('deleteCart',['id' => $order_detail->id]) }}" class="btn btn-danger">Delete</a></td>
                        <td><button class="btn btn-primary" type="submit">Update</button></td>
                    </tr>
                    </form>
                    @endforeach 
                <tr>
                    <td colspan="3"><h5>The number of products : {{$subtotal}}</h5></td>
                    @if($order_details->isEmpty())
                    @else
                    <td colspan="2"><h5>Shipping fee : 40.000<span style="color:red"> đ</span></h5></td>
                    @php
                        $total_master = $total_price_result+40000;
                        echo '<td colspan="3"><h4 style="color:red">Total Amount: '.number_format(($total_master),0,'','.') .'đ</h4></td>';
                    @endphp
                @endif
                
                </h4></td>
                </tr>
                </tbody>
            </table>
            
            <div style="text-align:center"> 
                    @if (Session::has('error_Null_cart'))
                    <strong style="color:red" class="error_Null_cart">{{Session::get('error_Null_cart') }}</strong>
                    @endif  
                @if($order_details->isEmpty())
                    <button style="width: 140px; height: 40px;border-radius: 50px;background:#ECFDFF;color: black; border: none; font-weight: bold" class="btn btn-primary" id="oder" disabled>Buy</button>
                    @else
                    <button style="width: 140px; height: 40px;border-radius: 50px;background:#ECFDFF;color: black; border: none; font-weight: bold" class="btn btn-primary" onClick="pl()">Buy</button>
                @endif
                <a class="btn_1" id="test" href="{{route('historyorder')}}">Shoping history</a>
                <a class="btn_1" href="{{route('shopcategory',['id'=> 0])}}">Continue Shoping</a>  
            </div>
            @if ($errors->any())
                    <div class="alert alert-primary alert-dismissible">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            <p id="b"> </p>
       
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


    
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript"></script>
    <script src="{{asset('assets/js/myscript.js')}}"></script>

    <script type="text/javascript">
        function pl (a) {
            document.querySelector('#b').innerHTML =`
                                                    <form action='{{route('form_order')}}' method="post">
                                                        @csrf
                                                            <tr>
                                                                <div class="form-group">
                                                                    <label>Name:</label>
                                                                    <input type="text" class="form-control" name="name" placeholder="Please enter your phone"/>
                                                                </div>
                                                            </tr>   
    
                                                            <tr>
                                                                <div class="form-group">
                                                                    <label>Delivery address:</label>
                                                                    <input type="text" class="form-control" name="locationOrder" placeholder="Please enter your delivery address"/>
                                                                </div>
                                                            </tr>
    
                                                            <tr>
                                                                <div class="form-group">
                                                                    <label>Phone:</label>
                                                                    <input type="text" class="form-control" name="phone" placeholder="Please enter your phone"/>
                                                                </div>
                                                            </tr>   
    
                                                             <button class="btn btn-primary" style="width: 140px; height: 40px;border-radius: 50px;background:#ECFDFF;color: black; border: none; font-weight: bold">Payments</button>
                                                            <tr>
                                                                <select name="payment"> 
                                                                    <option value="1" id="1">Immediate</option>
                                                                    <option value="2" id="2">Transfer</option>
                                                                </select>
                                                            </tr>
                                                        </form>`;
        }
    </script>

@endsection