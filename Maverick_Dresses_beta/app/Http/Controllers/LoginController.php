<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SinupRequest;
use Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check() && $request->user()->level == 2){
            return redirect()->back();
            // return redirect()->route('home');
        }
        return view('login');
    }
    public function postlogin(LoginRequest $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $credentials["level"] = 2;
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('error', 'Incorrect account or password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function sinup(SinupRequest $request){
        $name = $request->name;
        session()->put('name', $name);
        $phone = $request->phone;
        session()->put('phone', $phone);
        $password = bcrypt($request->password); 
        session()->put('password', $password);
        $level = 2;
        session()->put('level', $level);
        $email_register = $request->email;
        session()->put('email', $email_register);
        $address = $request->address;
        session()->put('address', $address);
        $gender = $request->gender;
        session()->put('gender', $gender);
        $randomNumber = random_int(100000, 999999);
        $user_token = $randomNumber;
        session()->put('user_token', $user_token);
        Mail::send('emails.confirm-code-register-email',compact('name','randomNumber'), function($email) use($name,$email_register,$randomNumber){
            $email->subject('Maverick-Dresses');
            $email->to($email_register,$name,$randomNumber);      
        });
        return redirect()->route('fillConfirmCodeMailRegisTerView');
    }
    public function fillConfirmCodeMailRegisTerView(){
        return view('emails.fill-confirm-code-gmail-register');
    }
    public function fillConfirmCodeMailRegisTer(Request $request){
        $data = $request -> confirm_code;
        if(empty($data)){
            return redirect()->back()->with('confirm_code_error_null','Please enter the confirmation code');  
        }
        $check=false;
        $get_user_token = Session::get('user_token');
        if ($data == $get_user_token){
            $check=true;
        }
       
       
        $data_store['name'] = Session::get('name');
        $data_store['phone'] = Session::get('phone');
        $data_store['password'] = Session::get('password');
        $data_store ['address']= Session::get('address');
        $data_store['user_token'] = Session::get('user_token');
        $data_store['gender'] = Session::get('gender');
        $data_store['email'] = Session::get('email');
        $data_store['level'] = Session::get('level');
if($check==true){
            DB::table('user')->insert($data_store);
            $user_token_reset['user_token'] = null;
            DB::table('user')->where('user_token',$data)->update($user_token_reset);
            $request->session()->forget('user_token');
            return redirect()->route('login')->with('success', 'Sign Up Success');
        }
        else{
            return redirect()->back()->with('confirm_code_error','Confirmation code is incorrect');  
        }
    }
    public function registers(){
        return view('register');
    }
}