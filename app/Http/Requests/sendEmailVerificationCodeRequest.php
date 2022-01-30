<?php

namespace App\Http\Requests;

class sendEmailVerificationCodeRequest extends BaseRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "email" => 'required|email'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email ID',
        ];
    }
}
