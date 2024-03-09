<!DOCTYPE html>
<html lang="zxx">
	<head>
		<style type="text/css">
			li {
			    list-style: none;
			}
			.rating-css div {
			    color: #ffe400;
			    font-size: 30px;
			    font-family: sans-serif;
			    font-weight: 800;
			    text-align: center;
			    text-transform: uppercase;
			    padding: 20px 0;
			}
			.rating-css input {
			    display: none;
			}
			.rating-css input + label {
			    font-size: 60px;
			    text-shadow: 1px 1px 0 #8f8420;
			    cursor: pointer;
			}
			.rating-css input:checked + label ~ label {
			    color: #b4afaf;
			}
			.rating-css label:active {
			    transform: scale(0.8);
			    transition: 0.3s ease;
			}

			/* star_comment */

			.rating-csss div {
			    color: #ffe400;
			    font-size: 5px;
			    font-family: sans-serif;
			    font-weight: 100;
			    /* text-align: center; */
			    text-transform: uppercase;
			    padding: 10px 0;
			}
			.rating-csss input {
			    display: none;
			}
			.rating-csss input + label {
			    font-size: 20px;
			    text-shadow: 1px 1px 0 #8f8420;
			    cursor: pointer;
			}
			.rating-csss input:checked + label ~ label {
			    color: #b4afaf;
			}
			.rating-csss label:active {
			    transform: scale(0.8);
			    transition: 0.3s ease;
			}
			/* End of Star Rating */
		</style>
		<!-- Required meta tags -->
		@include('blockhome.head')
	</head>

	<body>
		<!--::header part start::-->
		@include('../blockhome.header_part')
		<!-- Header part end-->

		<!-- breadcrumb start-->
		<section>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="breadcrumb_iner">
							<div class="breadcrumb_iner_item"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- breadcrumb start-->
		<!--================End Home Banner Area =================-->

		<!--================Single Product Area =================-->
		<div class="product_image_area section_padding">
			<div class="container">
				<div class="row s_product_inner justify-content-between">
					<div class="col-lg-7 col-xl-7">
						<div class="product_slider_img">
							<div id="vertical">
								<table>
									@foreach($products as $product) @php $a=1; @endphp @foreach($data_image as $data_imag)

									<tr>
										<td colspan="5">
											@php if($a==1){ $avatar=$data_imag->src; $image =asset('images/'.$avatar); $htmlx ='
											<img
												id="main-img"
												width="100%"
												height="600px"
												src="';
                                                $htmly='"
											/>
											'; echo $htmlx.$image.$htmly; $a=0; } @endphp
										</td>
									</tr>
								</table>
								@endforeach @foreach($data_image as $data_imag) @php $avatar1=$data_imag->src; $image1 =asset('images/'.$avatar1); $htmlx2 = '
								    <img
									width="15%"
									height="150px"
									src="';
                                    $htmly='"
								/>
								'; echo $htmlx2.$image1.$htmly; @endphp @endforeach {{--
								<div class="image_product">
									@php // $image = $data_image; // $image_url = asset('images/' . $image); $a=1; foreach ($data_image as $data_imag){ if($data_imag->id_product == $product->id){ $avatar=$data_imag->src; $image
									=asset('images/'.$avatar); $htmlx ='
									<img
										class="'.$a.'"
										width="100%"
										height="560px"
										src="';
                          $htmly='"
									/>
									'; echo $htmlx.$image.$htmly; $a=2; } } @endphp --}} {{-- <img src="{{ $image_url }}" width="100%" height="560px" /> --}} {{--
								</div>
								--}} @endforeach
							</div>
						</div>
					</div>
					<div class="col-lg-5 col-xl-4">
						{{-- product_Details --}} @foreach($products as $product)
						<form method="post" enctype="multipart/form-data" action="{{route('addToCart',['id'=>$product->id])}}">
							@csrf
							<div class="s_product_text" style="position: sticky; position: -webkit-sticky; top: 10px;">
								<li>
									<h2>{{$product->name}}</h2>
								</li>
								<h2 class="456">{{number_format(($product->price),0,'','.')}}₫</h2>
								<ul class="list">
									<li>
										<a class="active" href=""> <span>Category</span> : @php echo $name_category @endphp </a>
									</li>
									<li>
										<p><span>Content</span> : {{html_entity_decode(strip_tags( $product->content ))}}</p>
									</li>
									<li>
										<p><span>Introduce</span> : {{html_entity_decode(strip_tags( $product->introduce ))}}</p>
									</li>
								</ul>
								<p>
									<span>Size</span> : @php foreach($product_size_colors as $product_size_color){ if($product_size_color->id_product == $product->id){ foreach($size_products as $size){ if( $product_size_color->id_size ==
									$size->id){ $name=$size->size; echo '
									<label class="btn btn-default text-center">
										<input type="radio" name="size[]" id="color_option_b1" autocomplete="off" value="'.$name.'" />
										<span class="text-xl">'.$name.'</span>
									</label>
									'; } } } } @endphp
								</p>
								<div class="card_area d-flex justify-content-between align-items-center">
									<div class="product_count">
										<span class="input-number-decrement"> <i class="ti-minus"></i></span>
										<input class="input-number" type="text" value="1" min="0" max="10" name="quantity" />
										<span class="input-number-increment"> <i class="ti-plus"></i></span>
										
									</div>
									<button class="btn_3" type="submit">Add To Cart</button>
								</div>
								@if (Session::has('error_quantity'))
									<strong class="error_quantity" style="color:red">{{Session::get('error_quantity') }}</strong>
								@endif 
								@if (Session::has('error_size'))
									<strong class="error_quantity" style="color:red">{{Session::get('error_size') }}</strong>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!--================End Single Product Area =================-->
		<!--================Product Description Area =================-->
		<section class="product_description_area">
			<div class="container">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Review</a>
					</li>
				</ul>

				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="table-responsive"></div>
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<div class="row">
							<div class="col-lg-6">
								<div class="comment_list">
									<div class="review_item">
										<div class="media">
											<div class="d-flex"></div>
											<div class="media-body"></div>
										</div>
									</div>
									<div class="review_item reply">
										<div class="media">
											<div class="d-flex"></div>
											<div class="media-body"></div>
										</div>
									</div>
									<div class="review_item">
										<div class="media">
											<div class="d-flex"></div>
											<div class="media-body"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="review_box"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
						<div class="row">
							<div class="col-lg-6">
								<div class="row total_rate">
									<div class="col-6">
										<div class="box_total" style="width: 550px; margin-bottom: 10px;">
											<h4>{{number_format($average_star_rating,1,'.',",")}}</h4>
											<h6>({{$count_review}})</h6>
										</div>
									</div>
								</div>

								@foreach($comments as $comment)
								@if($comment->status == 2)
								<div class="review_list">
									<div class="review_item">
										<div class="media">
											<div class="d-flex">
												<img style="background: #ffffff; border-radius: 50%; height: 90px; margin: 20px; padding: 0px; width: 90px;" src="{{asset('images/user.jpg')}}" alt="" />
											</div>
											<div class="media-body">
												<h4>@php foreach($users as $user){ if($user->id==$comment->id_user){ $name_store=$user->name; echo $name_store; } } @endphp</h4>
												{{-- Sao --}}
												<div class="rating-csss">
													<div class="star-icon">
														@php $store=$comment->star_rating; for($count=1;$count<=5;$count++){ if($store==$count){ $htmx='
														<input type="radio" value="'.$count.'" name="product_rating'.$count.'" checked id="rating'.$count.'s" /><label for="rating'.$count.'s" class="ti-star"></label>'; echo $htmx; }else{
														$html='<input type="radio" value="'.$count.'" name="product_rating'.$count.'" /> <label for="rating'.$count.'s" class="ti-star" id="rating'.$count.'s"></label>'; echo $html; } }
														@endphp
													</div>
												</div>
											</div>
										</div>
										<p>
											{{strip_tags($comment->content)}}
										</p>
									</div>
								</div>
								@endif
								@endforeach
							</div>

							<div class="col-lg-6">
								<div class="review_box">
									<h4>Rating</h4>
									<form class="row contact_form" action="{{route('getComment',['id'=>$product->id])}}" method="post" novalidate="novalidate">
										<div class="rating-css">
											<div class="star-icon">
												<input type="radio" value="1" name="product_rating" checked id="rating1" />
												<label for="rating1" class="ti-star"></label>
												<input type="radio" value="2" name="product_rating" id="rating2" />
												<label for="rating2" class="ti-star"></label>
												<input type="radio" value="3" name="product_rating" id="rating3" />
												<label for="rating3" class="ti-star"></label>
												<input type="radio" value="4" name="product_rating" id="rating4" />
												<label for="rating4" class="ti-star"></label>
												<input type="radio" value="5" name="product_rating" id="rating5" />
												<label for="rating5" class="ti-star"></label>
											</div>
										</div>

										@csrf
										<div class="col-md-12">
											<div class="form-group">
												<h2><strong>Comment</strong></h2>
												<textarea class="form-control" style="height: 50%;" name="comment" id="message" cols="50" rows="10" placeholder="Enter your comment..."></textarea>
											</div>
										</div>
										<div class="col-md-12 text-right" align="center">
											<button type="submit" value="submit" class="btn_3">
												POST
											</button>
										</div>
									</form>
									@endforeach
								</div>
							</div>
						</div>
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
						  <a href="{{route('historyorder')}}"><i class="icon ion-social-snapchat" title="áp con ma"></i></a>
						  <a href="{{route('contact')}}"><i class="icon ion-social-instagram" title="instagram"></i></a>
						</div>
					</div>
					{{-- <p class="copyright">Company Name © 2018</p> --}}
				</div>
			</footer>
		</div>
	
		<!--================End Product Description Area =================-->

		<!-- product_list part start-->

		<!-- product_list part end-->

		{{-- @include('../blockhome.footer_part') --}}
		<!--::footer_part end::-->

		<!-- jquery plugins here-->
<script src="{{asset('assets/js/jquery-1.12.1.min.js')}}"></script>
<!-- popper js -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- easing js -->
<script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('assets/js/swiper.min.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('assets/js/masonry.pkgd.js')}}"></script>
<!-- particles js -->
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<!-- slick js -->
<script src="{{asset('assets/js/slick.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/contact.js')}}"></script>
<script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.form.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/mail-script.js')}}"></script>
<script src="{{asset('assets/js/stellar.js')}}"></script>
<script src="{{asset('assets/js/price_rangs.js')}}"></script>
<!-- custom js -->
<script src="{{asset('assets/js/custom.js')}}"></script>
	</body>
	{{-- <script src="{{asset('jquery-3.6.0.min.js')}}"></script> --}}
	{{-- <script src="{{asset('assets/js/slick.min.js')}}"></script> --}}
	<script type="text/javascript">
		$(document).ready(function () {
		    // g=$('[type="text"][class="input-numberrrrrrrr"]').attr('name');
		    // alert(g);

		    $(".input-number-increment").click(function ($c, $e) {
		        a = $(".input-number").val(); //1
		        ntang = parseInt(a, 10); //so1
		        a = ntang; //so2
		        $(".input-number").val(a); //thayso2vo
		    });
		    $(".input-number-decrement").click(function ($c, $e) {
		        b = $(".input-number").val();
		        ngiam = parseInt(b, 10);
		        if (ngiam > 1) {
		            b = ngiam;
		            $(".input-number").val(b);
		        }
		    });

		    $("img").click(function () {
		        imgPath = $(this).attr("src");
		        //  alert(imgPath);
		        $("#main-img").attr("src", imgPath);
		    });
		});
	</script>
	<!--================End Cart Area =================-->
</html>
