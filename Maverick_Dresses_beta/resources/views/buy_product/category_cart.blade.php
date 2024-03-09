@extends('home')

@section('content')
<!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    
    <!-- breadcrumb start-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li></li><h3><a href="{{route('shopcategory',['id'=>0])}}" style="color:black;text-decoration: none">All Categories</a></h3><li>
                                        @php
                                            foreach($categorys as $cate){
                                                if($cate->parent == 0 && $cate->name != 'Hot'){
                                                    echo '<li><h3>'.$cate->name.'</h3></li>';
                                                    foreach($categorys as $category){
                                                        if($category->parent == $cate->id){
                                                        echo '<li>
                                                            <a href="'.route('shopcategory',       ['id'=>$category->id]).'">'.$category->name.'</a>
                                                            </li>';
                                                        }
                                                    }
                                                    echo'<hr/ >';
                                                }
                                            }
                                        @endphp
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                {{-- search --}}
                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <form method="get" action="" class="form-inline" role="form">
                                            <div class="form-group">
                                                <input type="text" style="width:80%; border-radius:5px; height:3.5%;"
                                                placeholder="Search name" name="search" class="form-control search" id="search">
                                                <button type="submit" class="input-group-text" style="padding:10px 10px;margin-left:1px;background:white">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- builCart --}}
                    
                    <div class="row align-items-center latest_product_inner">
                        @foreach ($products as $product)
    
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <td>
                                    @php
                                    $a=1;
                                    foreach ($data_image as $img) {
                                        if($img->id_product == $product->id &&$a==1) {
                                            $avatar = $img->src;
                                            $image = asset('images/' . $avatar);
                                            echo '<img width="95%" height="280px" src="' . $image . '">';
                                            $a=2;
                                        }
                                    }
                                    @endphp
                                </td>
                                    <div class="single_product_text">
                                        {{-- <h3><a style="text-decoration:none"href="{{route('productdetails',['id'=>$product->id])}}">{{$product->name}}</a></h3> --}}
                                        <h3>{{$product->name}}</h3>
                                        <div class="flex items-center">
                                            <div class="pmmxKx"><h3 style="color:red">{{number_format(($product->price),0,'','.')}} ₫<h3>
                                            </div>
                                        </div>
                                        <div class="information"><a  style="text-decoration: none;" class="add_cart" href="{{route('productdetails',['id'=>$product->id])}}" class="">Infomation</a></div>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                        
                        <div class="col-lg-12">
                            <div class="pageination">
                                <div class="text-center">
                                    {{$products->appends(request()->all())->links()}}
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>@include('../blockhome.footer_part')</div>
    <!--================End Category Product Area =================-->
@endsection
