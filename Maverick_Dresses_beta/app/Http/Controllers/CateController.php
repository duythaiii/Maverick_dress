<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
class CateController extends Controller
{
    public function create() {
        $category = DB::table('category')->get();
        
        return view('admin.category.create',['categorys' => $category]);
    }

    public function store(StoreRequest $request) {
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        DB::table('category')->insert($data);
        return redirect()->route('admin.category.index')->with('success', 'More success');
    }

    public function index() {
        $category = DB::table('category')->get();
        $datas = DB::table('category')->get();
        return view('admin.category.index',['category' => $category,'categorys' => $datas]);
    }

    public function update(UpdateRequest $request,$id){
        $categorys = DB::table('category')->get();
        foreach($categorys as $category){
            if($category->id == $request->parent){
                if($category->parent == $id){
                    return redirect()->route('admin.category.edit',['id'=>$id])->with('error', 'Can not be my baby');
                }
            }
        }
        if($request->parent == $id){
            return redirect()->route('admin.category.edit',['id'=>$id])->with('error', 'Not its child');
        }
        $data = $request-> except('_token');
        DB::table('category')->where('id',$id)->update($data);
        return redirect()->route('admin.category.index')->with('success', 'Edit is successful');
    }

    public function edit($id){
        $category = DB::table('category')->where('id', $id)->first();
        $datas = DB::table('category')->get();
        return view('admin.category.edit',['edit'=>$category,'category'=> $datas]);
    }

    public function delete ($id) {
        $delete_category= DB::table('category')->get();
        $detele_product = DB::table('products')->get();
        foreach($detele_product as $deletee){
            if($deletee->id_category == $id){
                return redirect()->route('admin.category.index')->with('error', '
                The category cannot be deleted because it contains products');
            }
        }
        
        foreach($delete_category as $delete){
            if($delete->parent == $id){
                return redirect()->route('admin.category.index')->with('error', 'The category cannot be deleted because it contains subcategories');
            }
        }
            DB::table('products')->where('id_category',$id)->delete();
            DB::table('category')->where('id',$id)->delete();
            return redirect()->route('admin.category.index')->with('success', 'Deleted successfully');
        
    }
}
