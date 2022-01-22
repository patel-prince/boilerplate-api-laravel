<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class VerifyEmailRequest extends BaseRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "verification_code" => 'required|valid_hash_token'
        ];
    }

    public function attributes()
    {
        return [
            "verification_code" => "Verification Code"
        ];
    }
}
