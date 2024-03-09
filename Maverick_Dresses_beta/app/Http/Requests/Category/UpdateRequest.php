<?php

namespace App\Http\Requests\Category;

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
            'name' => request()->route('id')
            ? 'required|unique:category,name,'.request()->route('id')
            :'required|unique:category', 
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Please enter category.',
            'name.unique'=>'Name already exists.',
        ];
    }
}