<?php

namespace App\Services;

use App\Http\Requests\Auth\RegisterWithEmailRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Repositories\AuthRepository;
use App\Traits\HelperTrait;

class AuthService extends BaseService
{
    use HelperTrait;

    private AuthRepository $auth;

    public function __construct(AuthRepository $auth)
    {
        $this->auth = $auth;
        parent::__construct($auth);
    }

    public function registerWithEmail(RegisterWithEmailRequest $request, $verification_details)
    {
        $data = $request->only(['firstname', 'lastname', 'email', 'password']);
        $data['email_verification_code'] = $verification_details['code'];
        return $this->auth->create($data);
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $data = $request->only('verification_code');
        return $this->auth->markAsVerified($data);
    }
}
