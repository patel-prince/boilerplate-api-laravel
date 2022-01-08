<?php

namespace App\Services;

use App\Http\Requests\Auth\RegisterWithEmailRequest;
use App\Repositories\AuthRepository;
use App\Traits\HelperTrait;

class AuthService
{
    use HelperTrait;

    private AuthRepository $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->auth = $auth;
    }

    public function registerWithEmail(RegisterWithEmailRequest $request, $verification_details)
    {
        $data = $request->only(['firstname', 'lastname', 'email', 'password']);
        $data['email_verification_code'] = $verification_details['code'];
        return $this->auth->create($data);
    }
}
