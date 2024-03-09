<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSize extends FormRequest
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
            'size'=>'required|unique:size_product,size,'.$this()->id,
        ];
    }

    public function messages(){
        return [
            'size.required'=>'Please enter size',
            'size.unique'=>'Size already exists.',
        ];
    }
}
