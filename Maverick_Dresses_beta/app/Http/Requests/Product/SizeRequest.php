<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'size'=>['required','unique:size_product'],
        ];
    }

    public function messages()
    {
        return [
            'size.required'=>'Enter your size.',
            'size.unique'=>'Dimensions already exist.',
            
        ];
    }
}

