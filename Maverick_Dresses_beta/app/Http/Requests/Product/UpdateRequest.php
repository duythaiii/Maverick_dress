<?php

namespace App\Http\Requests\Product;

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
            'price'=>['required','numeric'],
            'introduce'=>['max:255','min:10'],
            'content'=>['max:255','min:10'],
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Please enter product name',
            'price.required'=> 'Please enter price',
            'introduce.max'=>'Exceeded the allowed number of 255 characters.',
            'introduce.min'=>'Referral must be at least 10 characters.',
            'content.max'=>'Exceeded the allowed number of 255 characters.',
            'content.min'=>'Content must be at least 10 characters.',
        ];
    }
}
