<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>'required',
            'price'=>'required|numeric',
            'info'=>'required',
            'overview'=>'required',
            'inventory'=>'required|numeric',
            'file'=>'filled|required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Please Inter Product Name ... ',
            'price.required'=>'Please Inter Price ... ',
            'price.numeric'=>'Price Must Is Numeric ...',
            'info.info'=>'Please Inter Info ...',
            'overview.required'=>'Please Inter Review ...',
            'inventory.required'=>'Please Inter Inventory ...',
            'inventory.numeric'=>'Inventory Must Is Numeric ...',
            'file.required'=>'Please upload at last one picture ...',   
        ];
    }
}
