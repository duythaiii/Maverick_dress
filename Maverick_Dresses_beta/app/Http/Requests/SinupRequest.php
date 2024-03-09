<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SinupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> ['required'],
            'email' => ['required','unique:user','email'],
            'password' => ['required','min:5','max:10'],
            'password_confirmtion'=> ['same:password'],
            'phone'=> ['required'],
            'address'=> ['required'],
        ];
    }
    public function messages(){
        return [
            'name.required'=> 'Please enter username.',
            'email.required'=> 'Please enter email.',
            'email.unique'=> 'Email already exists.',
            'email.email'=> 'Email is not structured properly',
            'password.required'=> 'Please enter a password',
            'password_confirmtion.same'=> 'Password does not match.',
            'password.min'=>'Password must be at least 5 characters.',
            'password.max'=>'Password maximum 10 characters.',
            'phone.required'=> 'Please enter phone.',
            'address.required'=> 'Please enter your address.',
        ];
    }
}
