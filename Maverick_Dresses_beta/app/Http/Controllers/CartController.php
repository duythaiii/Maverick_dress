<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{   
    public function online(){
        $orders = DB::table('order')->where('payment','2')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }

    public function immidiate(){
        $orders = DB::table('order')->where('payment','1')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }

    public function orders_confirmation(){
        $orders = DB::table('order')->where('status','1')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function orders_confirmated(){
        $orders = DB::table('order')->where('status','2')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function orders_delivering(){
        $orders = DB::table('order')->where('status','3')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function list_order(){
            $orders = DB::table('order')->where('status','4')->orderBy('updated_at','DESC')->get();
            $users = DB::table('user')->get();
            return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function order_cancel(){
        $orders = DB::table('order')->where('status','5')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function returns_oder(){
        $orders = DB::table('order')->where('status','6')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function list_returns_oder(){
        $orders = DB::table('order')->where('status','7')->orderBy('updated_at','DESC')->get();
        $users = DB::table('user')->get();
        return view('admin.cart.order',['orders'=>$orders,'users'=>$users]);
    }
    public function order_detail($id){
        $order_details = DB::table('order_detail')->where('id_order', $id)->get();
        $product_sizes = DB::table('product_size')->get();
        $products = DB::table('products')->get();
        $sizes = DB::table('size_product')->get();
        $orders = DB::table('order')->where('id',$id)->first();
        $users = DB::table('user')->where('id',$orders->id_user)->first();
        return view('admin.cart.order_detail',['order_details'=>$order_details,'product_sizes'=>$product_sizes,'products'=>$products,'sizes'=>$sizes,'users'=>$users,'orders'=>$orders]);
    }
    public function rating_products(){
        $rating_products = DB::table('rating_product')->where('status',1)->orderBy('id_user','DESC')->get();
        $users = DB::table('user')->get();
        $products = DB::table('products')->get();
        return view('admin.cart.rating_products',['rating_products'=>$rating_products,'users'=>$users,'products'=>$products]);
    }
    public function comment($id){
        $status['status'] = 2;
        DB::table('rating_product')->where('id',$id)->update($status);
        return redirect()->back();
    }
    public function delete_rating($id){
        DB::table('rating_product')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'The company deleted');
    }
    public function edit($id){
        $edits = DB::table('order')->where('id',$id)->first();
        return view('admin.cart.update',['edits'=>$edits]);
    }
    public function update(Request $request , $id){
        $data = $request->only('status','payment');
        $data['updated_at'] = new \Datetime();
        $check = DB::table('order')->where('id',$id)->first();
        DB::table('order')->where('id',$id)->update($data);
        if($data == 2){
            return redirect()->route('admin.cart.orders_confirmation')->with('success', 'Update success');
        }elseif($data==3){
            if($check->status == 1 ){
                return redirect()->route('admin.cart.orders_confirmation')->with('success', 'Update success');
            }else{
                return redirect()->route('admin.cart.orders_confirmated')->with('success', 'Update success');
            }
        }elseif($data== 4){
            return redirect()->route('admin.cart.orders_delivering')->with('success', 'Update success');
        }else{
            if($check->status == 1 ){
                return redirect()->route('admin.cart.orders_confirmation')->with('success', 'Update success');
            }elseif($check->status == 2){
                return redirect()->route('admin.cart.orders_confirmated')->with('success', 'Update success');
            }elseif($check->status == 3){
                return redirect()->route('admin.cart.orders_delivering')->with('success', 'Update success');
            }elseif($check->status == 6){
                return redirect()->route('admin.cart.returns_oder')->with('success', 'Update success');
            }else{
                return redirect()->route('admin.cart.list_order')->with('success', 'Update success');
            }
        }
    }
}
