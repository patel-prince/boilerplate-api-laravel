<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class RegisterWithEmailRequest extends BaseRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required|alpha_space',
            'lastname' => 'required|alpha_num_space',
            'email' => 'required|email|unique:users',
            'password' => 'required|password_format'
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email ID',
            'password' => 'Password'
        ];
    }
}
