<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'displayname'=>'required',
            'password'=>'required',
            'email'=>'required|unique:users,email|email'
        ];
    }

    public function messages(){
        return[
            'displayname.required'=>'Please enter display name',
            'email.required'=>'Please enter  email',
            'email.unique'=>'Email existed please choice different email ',
            'email.email'=>'Email illegal',
            'password.required'=>'Please enter password'
        ];
    }



}
