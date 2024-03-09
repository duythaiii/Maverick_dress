<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Str;
use Mail;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\FormOrderRequest;


class HomeController extends Controller
{
    public function home() {
        $categorys = DB::table('category')->get();
        $products_home= DB::table('products')->get();
        if(!$products_home->isEmpty()){
            $images = DB::table('image_product')->get();
            $products_home= DB::table('products')->get();
        }
        foreach($categorys as $category){
            if($category->name == 'Hot'){
                $products= DB::table('products')->where('id_category', $category->id)->get();
            }
        }
        foreach($products as $product){
            $imageshots[] = DB::table('image_product')->WHERE('id_product',$product->id)->first();
        }
        foreach($products_home as $product){
            $images[] = DB::table('image_product')->WHERE('id_product',$product->id)->first();
        }


        $product_size_colors = DB::table('product_size')->get();
        $size_products = DB::table('size_product')->get();
        return view('buy_product.index',['data_image'=>$images,'product_size_colors'=>$product_size_colors,'size_products'=>$size_products,'categorys'=>$categorys,'products'=>$products,'products_home'=>$products_home,'imageshots'=>$imageshots]);
    }


    public function shopcategory($id) {    
        if($id==0){
            $categorys = DB::table('category')->get();
            $sidebar_cate = DB::table('category')->get();
            $product_size_colors = DB::table('product_size')->get();
            $products = DB::table('products')->paginate(12);
            if($search=request()->search){
                $products = DB::table('products')->where('name','LIKE','%'.$search.'%')->ORWHERE('price','LIKE','%'.$search.'%')->paginate(12);
            }
            $size_products = DB::table('size_product')->get();
            $data_image = DB::table('image_product')->get();
            $sizes =DB::table('size_product')->get();
            return view('buy_product.category_cart', ['products'=>$products, 'data_image'=>$data_image,'categorys'=>$categorys,'product_size_colors'=>$product_size_colors,'size_products'=>$size_products,'sidebar_cate'=>$sidebar_cate,'sizes'=>$sizes]);
        }else{
            $sidebar_cate = DB::table('category')->where('id', $id)->first();
            $categorys = DB::table('category')->get();
            $products = DB::table('products')->where('id_category', $id)->paginate(9);
            
            if($search=request()->search){
                $products = DB::table('products')->where('id_category',$id)->where('name','LIKE','%'.$search.'%')->ORWHERE('price','LIKE','%'.$search.'%')->where('id_category',$id)->paginate(9);
            }
    
            $size_products = DB::table('size_product')->get();
            $product_size_colors = DB::table('product_size')->get();
            $data_image = DB::table('image_product')->get();
            return view('buy_product.category_cart', ['products'=>$products, 'data_image'=>$data_image,'size_products'=>$size_products,'product_size_colors'=>$product_size_colors,'sidebar_cate'=>$sidebar_cate,'categorys'=>$categorys]);
        }
        
    }
    

    public function addToCart(Request $request,$id) {//id của product
        if(Auth::check()){
            $data_sizess=$request->only('size');
            if(empty($data_sizess)){
                return redirect()->back()->with('error_size','Please choose size for product');
            }
            $data_update_order_details=[];
            foreach ($data_sizess as $data_sizes){
                foreach ($data_sizes as $data_size){
                    $status='ready';
                    $id_user=Auth::user()->id;
                    $id_order_object=DB::table('order')->where('id_user',$id_user)->where('status',$status)->first();
                    if(empty($id_order_object)){
                        $data_order['id_user']= $id_user;
                        $data_order['code_order']=Str::random(20);
                        $data_order['status']=$status;
                        DB::table('order')->insert($data_order);
                        $id_order_object2=DB::table('order')->where('id_user',$id_user)->where('status',$status)->first();
                        $id_order=$id_order_object2->id;
                        $name_size=$data_size;
                        $get_id_size_object=DB::table('size_product')->where('size',$name_size)->first();
                        
                        if(!empty($get_id_size_object)){
                            $get_id_size=$get_id_size_object->id;
                            $get_id_product_size_object= DB::table('product_size')->where('id_product',$id)->where('id_size',$get_id_size)->first();
                            $get_id_product_size= $get_id_product_size_object->id;
                            $data_old_order_details=DB::table('order_detail')->where('id_product_size',$get_id_product_size)->where('id_order',$id_order)->get();
                            if($data_old_order_details->isEmpty()){
                                if($request->quantity<0 || empty($request->quantity) || $request->quantity>=100){
                                    return redirect()->back()->with('error_quantity','Number of not a sound and small more than 100');
                                }
                                $data_update_order_details['quantity']=$request->quantity;//id_product_size
                                $data_update_order_details['id_order']=$id_order;
                                $data_update_order_details['id_product_size']=$get_id_product_size;
                                DB::table('order_detail')->insert($data_update_order_details);
                            }else{
                                if($request->quantity<0 || empty($request->quantity) || $request->quantity>=100){
                                    return redirect()->back()->with('error_quantity','Number of not a sound and small more than 100');
                                }
                                foreach($data_old_order_details as $data_old_order_detail)
                                $data_old_quantity = $data_old_order_detail->quantity;
                                $data_new_quantity = $data_old_quantity + $request->quantity;
                                $data_update_order_details['quantity']=$data_new_quantity;
                                DB::table('order_detail')->where('id_product_size',$get_id_product_size)->where('id_order',$id_order)->update($data_update_order_details);
                                return redirect()->back();
                            }
                            }  

                    }else{
                        $id_order=$id_order_object->id;
                        $name_size=$data_size;
                        $get_id_size_object=DB::table('size_product')->where('size',$name_size)->first() ;
                        
                        if(!empty($get_id_size_object)){
                            $get_id_size=$get_id_size_object->id;
                            $get_id_product_size_object= DB::table('product_size')->where('id_size',$get_id_size_object->id )->where('id_product',$id)->first();
                            $get_id_product_size= $get_id_product_size_object->id;
                            $data_old_order_details=DB::table('order_detail')->where('id_product_size',$get_id_product_size)->where('id_order',$id_order)->get();
                            if($data_old_order_details->isEmpty()){
                                if($request->quantity<0 || empty($request->quantity) || $request->quantity>=100){
                                    return redirect()->back()->with('error_quantity','Number of not a sound and small more than 100');
                                }
                                $data_update_order_details['quantity']=$request->quantity;//id_product_size
                                $data_update_order_details['id_order']=$id_order;
                                $data_update_order_details['id_product_size']=$get_id_product_size;
                                DB::table('order_detail')->insert($data_update_order_details);
                            }else{
                                if($request->quantity<0 || empty($request->quantity) || $request->quantity>=100){
                                    return redirect()->back()->with('error_quantity','Number of not a sound and small more than 100');
                                }
                                foreach($data_old_order_details as $data_old_order_detail)
                                $data_old_quantity = $data_old_order_detail->quantity;
                                $data_new_quantity = $data_old_quantity + $request->quantity;
                                $data_update_order_details['quantity']=$data_new_quantity;
                                DB::table('order_detail')->where('id_product_size',$get_id_product_size)->where('id_order',$id_order)->update($data_update_order_details);
                            }
                        }   
                    }
                    
                }
                return redirect()->route('shopingcart');
            }
            return redirect()->back();
        }else{
            return redirect()->route('login');
        }
    }

    public function addToCart2(Request $request,$id) {
        $data['quantity']=$request->quantity_cart;
        if($request->quantity_cart<0 || empty($request->quantity_cart) || $request->quantity_cart>=100){
            return redirect()->back()->with('error_Null_cart','Number of not a sound and small more than 100');
        }
        DB::table('order_detail')->where('id',$id)->update($data);
        return redirect()->back();
    }

    public function deleteCart ($id) {
        DB::table('order_detail')->where('id',$id)->delete();
        return redirect()->route('shopingcart');
    }


    public function confirm () {
        $status = '1';
        $data['status'] = $status;
        $id_user = Auth::user()->id;
        $order=DB::table('order')->where('id_user',$id_user)->where('status','ready')->first();
        $id_order=$order->id;
        $order_details=DB::table('order_detail')->where('id_order',$id_order)->get();
        if($order_details->isEmpty()){
            return redirect()->back()->with('error_Null_cart','Nothing in your cart, Payment??');
        }
        $product_size_colors = DB::table('product_size')->get();
        $products = DB::table('products')->get();
        $total_price_result=0;
        foreach ($order_details as $order_detail){
            foreach ($product_size_colors as $product_size_color){
                if($product_size_color->id==$order_detail->id_product_size){
                    foreach($products as $product){
                        if($product->id ==$product_size_color->id_product ){
                            $total_result=$product->price * $order_detail->quantity;
                            $total_price_result= $total_price_result + $total_result;
                        }
                    }
                }
            }
        }
        $total_price_result=$total_price_result+40000;
        $data['updated_at'] = new \DateTime;
        $data['total_price'] =$total_price_result;
        DB::table('order')->where('id_user',$id_user)->where('status','ready')->update($data);
        $email_customer = Auth::user()->email;
        $name_customer = Auth::user()->name;
        $code_order = $order->code_order;
        Mail::send('emails.mail-confirm-purchase-success',compact('name_customer','code_order','total_price_result'), function($email) use($name_customer,$email_customer,$code_order,$total_price_result){
            $email->subject('Maverick-Dresses');
            $email->to($email_customer,$name_customer);      
        });
        return redirect()->route('historyorder');
    }
    
    public function contact() {
        $categorys = DB::table('category')->get();
        return view('buy_product.contact',['categorys'=>$categorys]);
    }

    public function productdetails($id) { //id của product
        //comments
        $data_star_rating = DB::table('rating_product')->where('id_product',$id)->get();
        $users=DB::table('user')->get();
        $average_star_rating = DB::table('rating_product')->where('id_product',$id)->average('star_rating');
        if(!empty($average_star_rating)){   
            $average_star_rating=$average_star_rating;
        }else{
            $average_star_rating =0;
            $average_star_rating; 
        }
        $count_review=count($data_star_rating);
        //endcomments
        $products = DB::table('products')->where('id',$id)->get();
        $product_size_colorsss = DB::table('product_size')->get();
        $product_size_colors = DB::table('product_size')->get();
        $size_products = DB::table('size_product')->get();
        foreach($products as $product){
            $id_category_in_products_table = $product->id_category;
        }
        $category_data = DB::table('category')->where('id',$id_category_in_products_table)->first();
        $categorys = DB::table('category')->get();
        $name_category = $category_data->name;
        $data_image = DB::table('image_product')->where('id_product', $id)->get();
        return view('buy_product.product_details', ['products'=>$products,'data_image'=>$data_image, 'product_size_colors'=>$product_size_colors,'categorys'=>$categorys,'size_products'=>$size_products,'name_category'=>$name_category,'product_size_colorsss'=>$product_size_colorsss,'average_star_rating'=>$average_star_rating,'count_review'=>$count_review,'comments'=>$data_star_rating,'users'=>$users]);
    }

    public function historyorder() {
        $categorys = DB::table('category')->get();
        $id_user = Auth::user()->id;
        $orders= DB::table('order')->where('id_user',$id_user)->orderBy('updated_at','DESC')->get();
        $checksize = DB::table('size_product')->get();
        $product_size = DB::table('product_size')->get();
        $products = DB::table('products')->get();
        return view('showproduct.historyorder',['products'=>$products,'categorys'=>$categorys,'orders'=>$orders,'checksize'=>$checksize,'product_sizes'=>$product_size]);
    }

    public function confirmation() {
        $categorys = DB::table('category')->get();
        return view('buy_product.confirmation',['categorys'=>$categorys]);
    }


    public function shopingCart() {
        
        $categorys = DB::table('category')->get();
        $id_user = Auth::user()->id;
        $status ='ready';
        $order=DB::table('order')->where('id_user',$id_user)->where('status',$status)->first();
        $orders= DB::table('order')->where('id_user',$id_user)->where('status','success')->get();
        $checkorder = DB::table('order_detail')->orderBy('id','DESC')->get();
        $checksize = DB::table('size_product')->get();
        $product_size = DB::table('product_size')->get();
        if(!empty($order)){
            $id_order=$order->id;

            $order_details=DB::table('order_detail')->where('id_order',$id_order)->get();
            $subtotal=count($order_details);
            $products = DB::table('products')->get();
            $data_image = DB::table('image_product')->get();
            $size_products = DB::table('size_product')->get();
            // $color_products = DB::table('color_product')->get();
            $product_size_colors = DB::table('product_size')->get();
            
            $total_price_result=0;
            foreach ($order_details as $order_detail){
                foreach ($product_size_colors as $product_size_color){
                    if($product_size_color->id==$order_detail->id_product_size){
                        foreach($products as $product){
                            if($product->id ==$product_size_color->id_product ){
                                $total_result=$product->price * $order_detail->quantity;
                                $total_price_result= $total_price_result + $total_result;
                            }
                            
                        }
                    }
                }
            }
            return view('buy_product.shopingcart',['order_details'=>$order_details,'products'=>$products,'data_image'=>$data_image,'size_products'=>$size_products,'product_size_colors'=>$product_size_colors,'categorys'=>$categorys,'subtotal'=>$subtotal,'total_price_result'=>$total_price_result,'orders'=>$orders,'checkorder'=>$checkorder,'product_sizes'=>$product_size,'checksize'=>$checksize]);
        }else{
            $data_order['id_user']= $id_user;
            $data_order['code_order']=Str::random(20);
            $data_order['status']=$status;
            DB::table('order')->insert($data_order);
            $order=DB::table('order')->where('id_user',$id_user)->where('status',$status)->first();
            $id_order=$order->id;
            $order_details=DB::table('order_detail')->where('id_order',$id_order)->get();
            $subtotal=count($order_details);
            $products = DB::table('products')->get();
            $data_image = DB::table('image_product')->get();
            $size_products = DB::table('size_product')->get();
            // $color_products = DB::table('color_product')->get();
            $product_size_colors = DB::table('product_size')->get();
            $total_price_result=0;
            foreach ($order_details as $order_detail){
                foreach ($product_size_colors as $product_size_color){
                    if($product_size_color->id==$order_detail->id_product_size){
                        foreach($products as $product){
                            if($product->id ==$product_size_color->id_product ){
                                    $total_result=$product->price * $order_detail->quantity;
                                $total_price_result= $total_price_result + $total_result;
                            }
                            
                        }
                    }
                }
            }

            return view('buy_product.shopingcart',['order_details'=>$order_details,'products'=>$products,'data_image'=>$data_image,'size_products'=>$size_products,'product_size_colors'=>$product_size_colors,'categorys'=>$categorys,'subtotal'=>$subtotal,'total_price_result'=>$total_price_result,'orders'=>$orders,'checkorder'=>$checkorder,'checksize'=>$checksize,'product_sizes'=>$product_size]);
        }
    }

    public function getComment(Request $request,$id){
        if(Auth::check()){
            $id_user=Auth::user()->id;
            $update_rating_product['id_user']=$id_user;
            $update_rating_product['star_rating']= $request->product_rating;
            $update_rating_product['content'] =$request->comment;
            $update_rating_product['id_product']=$id;
            $update_rating_product['status']=1;
            DB::table('rating_product')->insert($update_rating_product);
            return redirect()->back();

        }else{
            return redirect()->route('login');
        }
    }

    public function history_detail ($id) {
        $order_details = DB::table('order_detail')->where('id_order', $id)->get();
        $product_sizes = DB::table('product_size')->get();
        $products = DB::table('products')->get();
        $sizes = DB::table('size_product')->get();
        $order = DB::table('order')->where('id',$id)->first();
        return view('showproduct.history_detail',['order_details'=>$order_details,'product_sizes'=>$product_sizes,'products'=>$products,'sizes'=>$sizes,'order'=>$order]);
    }

    public function profile(){
        $id_user=Auth::user()->id;
        $data_user = DB::table('user')->where('id',$id_user)->first();
        $email_user =  $data_user->email;
        $name_user = $data_user->name;
        $address_user = $data_user->address;
        $phone_user = $data_user->phone;
        $pass_user= $data_user->password;

        return view('profileMember',['id_user'=>$data_user,'data_user'=>$data_user,'email_user'=>$email_user,'name_user'=>$name_user,'address_user'=>$address_user,'phone_user'=>$phone_user,'pass_user'=>$pass_user]);
    }

    public function updateProfile(UpdateProfile $request,$id){
        $data=$request->except('_token','sex','email');
        $data['updated_at']= new \DateTime();
        DB::table('user')->where('id',$id)->update($data);
        return redirect()->back();
    }

    public function  updatePassword(Request $request,$id){
            $credentials =[
                'email' => $request->email,
                'password' =>  $request->password ,

            ]; 
            if(Auth::attempt($credentials)) {
                if(empty($request->password_new)){
                    return redirect()->back()->with('passwordNewNull', 'You have not entered a new password.');
                }
                if(empty($request->confirm_password_new)){
                    return redirect()->back()->with('ConfirmpasswordNewNull', 'You have not confirmed the new password.');
                }
                if($request->password_new==$request->confirm_password_new){
                    $new_pass['password'] = bcrypt($request->password_new);
                    DB::table('user')->where('id',$id)->update($new_pass);
                    return redirect()->back()->with('successPassword', 'Change password successfully.');
                }
                else{
                    return redirect()->back()->with('ErrorConfirmChangePassword','Password does not match');
                }
                
            }else{
                return redirect()->back()->with('ErrorChangePassword','Incorrect password');
            }
    }

    public function cancal_cart($id){
        $datas['status'] = 5;
        $datas['updated_at'] = new \Datetime();
        DB::table('order')->where('id',$id)->update($datas);
        return redirect()->back();  
    }
    public function returns($id){
        $datas['status'] = 6;
        $datas['updated_at'] = new \Datetime();
        DB::table('order')->where('id',$id)->update($datas);
        return redirect()->back();  
    }

    public function form_order(FormOrderRequest $request ){
        $user_id =Auth::user()->id;
        $datas = $request->except('_token');
        $check = $request->only('payment');
        DB::table('order')->where('id_user',$user_id)->where('status','ready')->update($datas);
        foreach($check as $data){
            if($data == 2){
                return redirect()->route('paypal');
            }else{
                return redirect()->route('confirm');
            }
        }
    }
    public function paypal(){
                $links = route('historyorder');
                $categorys = DB::table('category')->get();
                $id_user = Auth::user()->id;
                $status ='ready';
                $order=DB::table('order')->where('id_user',$id_user)->where('status',$status)->first();
                $orders= DB::table('order')->where('id_user',$id_user)->where('status','success')->get();
                $checkorder = DB::table('order_detail')->orderBy('id','DESC')->get();
                $checksize = DB::table('size_product')->get();
                $product_size = DB::table('product_size')->get();
                    $id_order=$order->id;

                    $order_details=DB::table('order_detail')->where('id_order',$id_order)->get();
                    $subtotal=count($order_details);
                    $products = DB::table('products')->get();
                    $data_image = DB::table('image_product')->get();
                    $size_products = DB::table('size_product')->get();
                    // $color_products = DB::table('color_product')->get();
                    $product_size_colors = DB::table('product_size')->get();
                    $total_price_result=0;
                    foreach ($order_details as $order_detail){
                        foreach ($product_size_colors as $product_size_color){
                            if($product_size_color->id==$order_detail->id_product_size){
                                foreach($products as $product){
                                    if($product->id ==$product_size_color->id_product ){
                                        $total_result=$product->price * $order_detail->quantity;
                                        $total_price_result= $total_price_result + $total_result;
                                    }
                                    
                                }
                            }
                        }
                    }
                    return view('buy_product.paypal',['order_details'=>$order_details,'products'=>$products,'data_image'=>$data_image,'size_products'=>$size_products,'product_size_colors'=>$product_size_colors,'categorys'=>$categorys,'subtotal'=>$subtotal,'total_price_result'=>$total_price_result,'orders'=>$orders,'checkorder'=>$checkorder,'product_sizes'=>$product_size,'checksize'=>$checksize,'links'=>$links]);
    }
}

