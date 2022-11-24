<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
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
            'desc'=>'required|string',
            'store'=>'required|numeric',
            'base_price'=>'required|integer|min:0',
            'discount_price'=>'required|integer|min:0|lt:base_price',
            'flag'=>'required|in:0,1'

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'name is Required',
            'name.string'=>'name must be string',
            'desc.required'=>'description is Required',
            'desc.string'=>'description must be string',
            'store.required'=>'store is Required',
            'store.string'=>'store Id must be number',
            'base_price.required'=>'base price is Required',
            'base_price.integer'=>'base price must be number',
            'base_price.min:0'=>'base price must be positive',
            'discount_price.required'=>'discount price is Required',
            'discount_price.integer'=>'discount price must be number',
            'discount_price.min:0'=>'discount price must be positive',
            'discount_price.lt:base_price'=>'discount price must be less than  base price',
            'flag.required'=>'flag is Required',
            'flag.in:0,1'=>'flag must be 0 or 1'
        ];
    }
}
