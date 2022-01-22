<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class BaseRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::check();
    }

    public function messages()
    {
        return [
            'required' => Config::get('messages.validation.required'),
            'alpha_space' => Config::get('messages.validation.alpha_space'),
            'alpha_num_space' => Config::get('messages.validation.alpha_num_space'),
            'email' => Config::get('messages.validation.email'),
            'unique' => Config::get('messages.validation.unique'),
            'password_format' => Config::get('messages.validation.password_format'),
            'valid_hash_token' => Config::get('messages.validation.valid_hash_token')
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }

}
