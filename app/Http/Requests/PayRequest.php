<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'fullname'=>'required',
            'email'=>'required',
            'owner'=>'required|numeric',
            'address'=>'required'
        ];
    }

    public function messages(){
        return [

            'fullname.required'=>'Bạn chưa nhập họ tên...',
            'email.required'=>'Bạn chưa nhập email...',
            'owner.required'=>'Bạn chưa nhập số điện thoại...',
            'owner.numeric'=>'Số điện thoại không hợp lệ',
            'address.required'=>'Bạn chưa nhập địa chỉ'

        ];
    }
}
