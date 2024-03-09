<?php

namespace App\Http\Requests\Product;

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
            'name'=>['required'],
            'price'=>['required','numeric'],
            'introduce'=>['required','max:255','min:10'],
            'content'=>['required','max:255','min:10'],
            'src'=>['required'],
            'size'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Please enter product.',
            'price.required'=>'Please enter price.',
            'price.numeric'=>'Must be number.',
            'introduce.required'=>'Please enter introduce.',
            'content.required'=>'Please enter content.',
            'src.required'=>'Please enter photo.',
            'size.required'=>'Please choose size.',

            'introduce.max'=>'Exceeded the allowed number of 255 characters.',
            'introduce.min'=>'Referral must be at least 10 characters.',

            'content.max'=>'Exceeded the allowed number of 255 characters.',
            'content.min'=>'Content must be at least 10 characters.',
        ];
    }
}
