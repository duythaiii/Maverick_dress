<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'password' => ['required','min:5','max:26'],
            'password_confirmtion'=> ['same:password'],
            'phone'=> ['required','max:10'],
            'address'=> ['required'],
        ];
    }
    public function messages(){
        return [
            'name.required'=> 'Please enter your username.',
            'email.required'=> 'Please enter your email.',
            'email.unique'=> 'Email already exists.',
            'email.email'=> 'Email is not structured properly.',
            'password.required'=> 'Please enter your password.',
            'password_confirmtion.same'=> 'Invalid password.',
            'password.min'=>'Password must be at least 5 characters.',
            'password.max'=>'Maximum password is 26 characters.',
            'phone.required'=> 'Please enter the phone number.',
            'phone.numeric'=>'Must be number.',
            'phone.max'=>'The maximum number of phone numbers is 10 numbers.',
            'address.required'=> 'Please enter your address.',
        ];
    }
}
