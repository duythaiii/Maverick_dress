<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\SizeRequest;
use App\Http\Requests\Product\UpdateSize;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ProductController extends Controller
{
    public function index () {
        $products = DB::table('products')->orderBy('id','DESC')->get();
        $categorys = DB::table('category')->get();

        foreach($products as $product) {
            $data_image[]= DB::table('image_product')->where('id_product', $product->id)->first();
        }
        $size_product = DB::table('size_product')->get();
        $product_size_color = DB::table('product_size')->get();
        return view('admin.product.index',['products' => $products,'data_image' => $data_image,'categorys' => $categorys,'size_products'=>$size_product,'product_size_colors'=>$product_size_color]);
    }

    public function create () {
        $category = DB::table('category')->get();
        $sizes = DB::table('size_product')->get();
        return view('admin.product.create', ['categorys'=>$category,'sizes'=>$sizes]);
    }

    public function edit($id){
        $datas= DB::table('image_product')->get();
        $truy_van= DB::table('products')->where('id',$id)->first();
        $categorys = DB::table('category')->get();
        $sizes= DB::table('size_product')->get();
        $product_size_colors = DB::table('product_size')->get();
        return view('admin.product.edit',['products'=> $truy_van,'data_image'=>$datas, 'categorys'=>$categorys, 'product_size_colors'=>$product_size_colors,'sizes'=>$sizes]);
    }

    public function update (UpdateRequest $request, $id) {
        $data = $request->except('_token','src','size','id_product');
        $sizess = $request->only('size'); // mang trong mang
        if(!empty($sizess)){
            foreach ($sizess as $size){ // lay 1 mang
                foreach($size as $sz){ // mang con lai
                    $chekidsize = DB::table('size_product')->where('size', $sz)->first();
                    $size_products[] = $chekidsize->id;
                    }
                }
                $delete_orders =DB::table('product_size')->where('id_product', $id)->get();
                foreach($delete_orders as $order){
                    $delete_order= DB::table('order_detail')->where('id_product_size', $order->id)->get();
                    DB::table('order_detail')->where('id_product_size', $order->id)->delete();
                    foreach($delete_order as $delete_orde){
                        DB::table('order')->WHERE('id',$delete_orde->id_order)->WHERE('status','ready')->delete();
                    }
                }
                DB::table('product_size')->where('id_product', $id)->delete();
                $product_size = [];
                foreach($size_products as $size_product){
                $product_size['id_product'] = $id;
                $product_size['id_size'] = $size_product;
                DB::table('product_size')->insert($product_size);
                }
        }

        if(!empty($request->src)){
            DB::table('image_product')->where('id_product', $id)->delete();
            $data_images=$request->src;
            foreach ($data_images as $image) {
                $imageName = time().'.'.$image->getClientOriginalName();  
                $image->move(public_path('images'), $imageName);
                $data_product_image['src']= $imageName;
                $data_product_image['id_product'] = $id;
                DB::table('image_product')->insert($data_product_image);
                }
        }
        DB::table('products')->where('id', $id)->update($data);
        return redirect()->route('admin.product.index')->with('success', 'Edit is successful');
        }

    public function store (StoreRequest $request) {
        $sizess = $request->only('size'); // mang trong mang
        foreach ($sizess as $size){ // lay 1 mang
          foreach($size as $sz){ // mang con lai
            $chekidsize = DB::table('size_product')->where('size', $sz)->first();
            $size_products[] = $chekidsize->id;
            }
        }
        
        // show src img
        $data = $request->only('name','id_category', 'content','introduce','price');
        $product_id = DB::table('products')->insertGetId($data);
        $data_images= $request->src;
        foreach ($data_images as $image) {
            $imageName = time().'.'.$image->getClientOriginalName();  
            $image->move(public_path('images'), $imageName);
            $data_product_image['src']= $imageName;
            $data_product_image['id_product'] = $product_id;
            DB::table('image_product')->insert($data_product_image);
        }
        
        $product_size = [];
        foreach($size_products as $size_product){
        $product_size['id_product'] = $product_id;
        $product_size['id_size'] = $size_product;
        DB::table('product_size')->insert($product_size);
        }
        return redirect()->route('admin.product.index')->with('success', '
        Create successful products');
    }

    
    public function delete ($id) {
        DB::table('rating_product')->where('id_product', $id)->delete();
        DB::table('image_product')->where('id_product', $id)->delete();
        $delete_orders = DB::table('product_size')->where('id_product', $id)->get();
            foreach($delete_orders as $deleteorder){
                $delete_order= DB::table('order_detail')->where('id_product_size', $deleteorder->id)->get();
                DB::table('order_detail')->where('id_product_size', $deleteorder->id)->delete();
                foreach($delete_order as $delete_orde){
                    DB::table('order')->WHERE('id',$delete_orde->id_order)->WHERE('status','ready')->delete();
                }
            }
        DB::table('product_size')->where('id_product', $id)->delete();
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('admin.product.index')->with('success', 'Deleted successfully');
    }


    // // tao size
    public function createsize () {
        return view('admin.product.createsize');
    }
    public function storesizes (SizeRequest $request) {
        $datas = $request->except('_token');
        DB::table('size_product')->insert($datas);
        return redirect()->route('admin.product.indexsize');
    }
    public function indexsize () {
        $sizes = Db::table('size_product')->simplePaginate(5);
        return view('admin.product.indexsize',['sizes'=>$sizes]);
    }
    public function deletesize ($id) {
        $delete_orders =DB::table('product_size')->where('id_size', $id)->get();
        foreach($delete_orders as $order){
            $delete_order= DB::table('order_detail')->where('id_product_size', $order->id)->get();
            DB::table('order_detail')->where('id_product_size', $order->id)->delete();
            foreach($delete_order as $delete_orde){
                DB::table('order')->WHERE('id',$delete_orde->id_order)->WHERE('status','ready')->delete();
            }
        }
        DB::table('product_size')->where('id_size', $id)->delete();
        DB::table('size_product')->where('id', $id)->delete();
        return redirect()->route('admin.product.indexsize')->with('success', 'Deleted successfully');
    }

    public function upload(Request $request) {
        $imageName = time().'-'.$request->upload->getClientOriginalName();
        $request->upload->move(public_path('ckeditor/'),$imageName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('ckeditor/'.$imageName);
        $msg = 'Images successfully uploaded';
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $re;
    }
}
