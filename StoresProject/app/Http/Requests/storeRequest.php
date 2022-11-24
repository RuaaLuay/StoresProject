<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'name'=>'required|string',
            'address'=>'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'name is Required',
            'name.string'=>'name must be string',
            'address.required'=>'address is Required',
            'address.string'=>'address must be string',
            'logo.required'=>'logo is Required',
            'logo.image'=>'logo must be an image'
        ];
    }
}
