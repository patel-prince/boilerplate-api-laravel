<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class SendEmailVerificationCodeRequest extends BaseRequest
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
