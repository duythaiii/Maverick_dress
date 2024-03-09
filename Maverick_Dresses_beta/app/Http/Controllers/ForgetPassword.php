<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class ForgetPassword extends Controller
{
    public function forget_pass(){
        return view('emails.forgetpass');
    }
    public function recoverPass(Request $request){
        $request->validate([
            'confirm_email' => 'required',
        ],[
            'confirm_email.required' =>  'Please enter your email so we can send a confirmation code',
        ]);
        
        $data= $request->confirm_email;
        $checkwithget = DB::table('user')->where('email','=',$data)->get();
        
        // echo $token_random = Str::random(20);
        if ($checkwithget->isEmpty()){   
            return redirect()->back()->with('mail_error','This email is not registered');  
        }
        else{   
            $checkwithfirst = DB::table('user')->where('email','=',$data)->first();
            $name= $checkwithfirst ->name;
            $id = $checkwithfirst ->id;
            $randomNumber = random_int(100000, 999999);
            
            DB::table('user')
            ->updateOrInsert(
                ['email' => $data],
                ['user_token' => $randomNumber]
            );
            Mail::send('emails.send-to-user',compact('name','randomNumber','id'), function($email) use($name,$data,$randomNumber,$id){
                $email->subject('Maverick-Dresses');
                $email->to($data,$name,$randomNumber,$id);      
            });
            return redirect()->route('fillConfirmCodeView');
            
        };
    }
    public function fillConfirmCodeView(){
        return view('emails.fill-confirm-code');
    }
    public function fillNewPasswordView($id){
        return view('emails.fill-new-password',['id'=>$id]);
    }
    public function fillConfirmCode(Request $request){
        $data = $request -> confirm_code;
        if(empty($data)){
            return redirect()->back()->with('confirm_code_error_null','Please enter the confirmation code');  
        }
        
        $reset=null;
        $checkcode = DB::table('user')->where('user_token','=',$data)->get();
        if ($checkcode->isEmpty()){   
            return redirect()->back()->with('confirm_code_error','Confirmation code is incorrect');  
        }
        else{
            $checkcodegetmail = DB::table('user')->where('user_token','=',$data)->first();

            $checkcodegetmail1 = $checkcodegetmail->id;
            DB::table('user')
            ->updateOrInsert(
                ['user_token' => $data],
                ['user_token' =>  $reset]
            );
            return redirect()->route('fillNewPasswordView',['id' => $checkcodegetmail1]);
            
        };
    }
    public function fillNewPassword(Request $request,$id){
        $data1 = $request -> newpassword;
        $data2 = $request -> confirmnewpassword; 
        if(empty($data1)){
        return redirect()->route('fillNewPasswordView',['id' => $id])->with('confirm_pass_error_old_null','Please enter a new password');  
        }
        if(empty($data2)){
            return redirect()->route('fillNewPasswordView',['id' => $id])->with('confirm_pass_error_new_null','Please confirm new password');  
        }
        
        if ($data1 == $data2 ){
            DB::table('user')
            ->updateOrInsert(
                ['id' => $id],
                ['password' =>  bcrypt($data1)]
            );
            return redirect()->route('login')->with('success', 'Change password successfully');
        }
        else{
            return redirect()->route('fillNewPasswordView',['id' => $id])->with('confirm_new_pass_error','Confirm password does not match, please re-enter');  
        };
    
    }
}