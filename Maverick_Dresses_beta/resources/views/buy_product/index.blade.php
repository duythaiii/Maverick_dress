
@extends('home')
<link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
@section('content')
<div class="CSSgal">
    <s id="s1"></s> 
    <s id="s2"></s>
    <s id="s3"></s>
    <s id="s4"></s>
    <div class="slider">
      <div style="background-image: url('{{asset('assets/img/slider-home/slider4.jpg')}}')">
      </div>
      <div style="background-image: url('{{asset('assets/img/slider-home/slider-1.jpg')}}');">
      </div>
      <div style="background-image: url('{{asset('assets/img/slider-home/slider-2.jpg')}}');">
      </div>
      <div style="background-image: url('{{asset('assets/img/slider-home/slider-3.jpg')}}');">
      </div>
    </div>
    
    <div class="prevNext">
      <div><a href="#s4"></a><a href="#s2"></a></div>
      <div><a href="#s1"></a><a href="#s3"></a></div>
      <div><a href="#s2"></a><a href="#s4"></a></div>
      <div><a href="#s3"></a><a href="#s1"></a></div>
    </div>
  
    <div class="bullets">
      <a href="#s1">1</a>
      <a href="#s2">2</a>
      <a href="#s3">3</a>
      <a href="#s4">4</a>
    </div>
  
  </div>
<!-- banner part start-->
{{-- <section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
            <div class="breadcrumb_iner">
                <div class="breadcrumb_iner_item">
                <h2>Simple, sophisticated and constantly improving</h2>
                <p>This is MAVERICK-DRESSES <span>-</span> Costumes that make a mark of quality</p>
                </div>
            </div>
            </div>
        </div>
    </div>
</section> --}}
<div id="slideCont" style="clip: rect(auto, 425px, 90px, auto); overflow: inherit; height: 30%; position: relative; = z-index: 1;">
    <div id="slideA" style="height: 300px; left: -194px; overflow: inherit; position: absolute; top: 100px; width: 1000px; z-index: 1;">
    <div id="innerSlideA" style="float: left;">
        <a href="{{route('contact')}}" style="text-decoration:none;color:red"><img src="{{asset('assets/img/12.jpg')}}" alt=""></a>
    </div>
    <div id="slideB" style="height: 90px; left: 0px; overflow: hidden; position: relative; top: 0px; width: 825px; z-index: 1;">
        <a href="http://www.apache.org/"></a>
        </div>
    </div>
</div>

<section class="product_list section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Top selling</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product_list_slider owl-carousel">
                    <div class="single_product_list_slider">
                        <div class="row align-items-center justify-content-between">
                            @php
                                foreach($products as $product){
                                    echo '<div class="col-lg-4 col-sm-6">
                                            <div class="single_product_item">
                                            <td>';
                                                foreach ($imageshots as $img) {
                                                    if($img->id_product == $product->id) {
                                                        $avatar = $img->src;
                                                        $image = asset('images/' . $avatar);
                                                        echo '<img width="100%" height="380px" src="'. $image .'">';
                                                    }
                                                }
                                            
                                            echo'</td>
                                                <div class="single_product_text">
                                                    <h3>'.$product->name.'</h3>';
                                                    echo '<a href="'.route('productdetails',['id'=>$product->id]).'" class="add_cart"><i class="fa-solid fa-info" style="color:red">Details</i></a>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                @endphp
                            
                            <div class="col-lg-12">
                                <div class="pageination">
                                    <div class="text-center">
                                        {{-- {{ $products_home->links() }} --}}
                                        @php
                                            if(!$products_home->isEmpty()){
                                                // $products_home->links();
                                            }
                                            else{
                                                echo "No data";
                                            }
                                        @endphp
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_list part end-->
</section>

<script type="text/javascript">
    function clip() {
      // width of the banner container
      var contWidth = 425;
      // height of the banner container
      var contHeight = 90;
      var id1 = document.getElementById('slideA');
      var id2 = document.getElementById('slideB');
      id1.style.left = parseInt(id1.style.left)-1 + 'px';
      document.getElementById('slideCont').style.width = contWidth + "px";
      document.getElementById('slideCont').style.clip = 'rect(auto,'+ contWidth +'px,' + contHeight +'px,auto)';
      id2.style.display = '';
      if(parseFloat(id1.style.left) == -(contWidth))  {
       id1.style.left = '0px';
      }
      setTimeout(clip,25)
    }
    function addLoadEvent(func) {
      var oldonload = window.onload;
      if (typeof window.onload != 'function') {
        window.onload = func;
      } else {
        window.onload = function() {
          if (oldonload) {
            oldonload();
          }
          func();
        }
      }
    }
    addLoadEvent(function() {
      clip();
    });
    //-->
    </script>
<!--::subscribe_area part end::-->
<div>@include('../blockhome.footer_part')</div>
@endsection