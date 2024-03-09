<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>['required'],
            'email' => request()->route('id')
            ? 'required|email|unique:user,email,'.request()->route('id')
            :'required|unique:user',
            'phone'=> ['required'],
            'address'=> ['required'],
        ];
    }
    public function messages(){
        return [
            'name.required'=> 'Please enter your username.',
            'email.required'=> 'Please enter your email.',
            'email.unique'=> 'Email already exists.',
            'email.email'=> 'Email is not structured properly.',
            'phone.required'=> 'Please enter the phone number.',
            'address.required'=> 'Please enter your address.',
        ];
    }
}
