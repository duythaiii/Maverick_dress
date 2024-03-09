<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data= DB::table('user')->get();

        return view('admin.user.index',['admins'=> $data]);
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(StoreRequest $request){
        $data= $request->except('_token','password_confirmtion');
        $data['password'] = bcrypt($request->password); 
        DB::table('user')->insert($data);
        return redirect()->route('admin.user.index')->with('success','Added success');
    }
    public function edit($id){
        $data= DB::table('user')->where('id',$id)->first();
        $edit_myself = null;
        if (Auth::user()->id == $id) {
            $edit_myself = true;
        } else {
            $edit_myself = false;
        }
        if(Auth::user()->id != 1 && ($id == 1 || ($data->level == 1 && $edit_myself == false))){
            return redirect()->route('admin.user.index')->with('error', 'You are not eligible to edit');
        }
        return view('admin.user.edit',['edit'=> $data]);
    }
    public function update(UpdateRequest $request,$id){
        $data= $request->except('_token','password');
        if(!empty($request->password)){
            $data['password'] = bcrypt($request->password);
        }
        DB::table('user')->where('id',$id)->update($data);
        return redirect()->route('admin.user.index')->with('success','Edit is successful.');
    }
    public function delete($id){
        $data= DB::table('user')->where('id',$id)->first();
        if(($id == 1) || (Auth::user()->id != 1 && $data->level == 1)){
            return redirect()->route('admin.user.index')->with('error', 'You are not eligible to delete.');
        }
        DB::table('rating_product')->where('id_user',$id)->delete();
        $delete_orders= DB::table('order')->where('id_user',$id)->get();
        foreach($delete_orders as $delete_order){
            DB::table('order_detail')->where('id_order',$delete_order->id)->delete();
        }
        DB::table('order')->where('id_user',$id)->delete();
        DB::table('user')->where('id','=',$id)->delete();
        return redirect()->route('admin.user.index')->with('success', 'Deleted successfully.');
    }
}
