<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterWithEmailRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Mail\EmailVerificationCodeMail;
use App\Services\AuthService;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    use HelperTrait;

    private AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function registerWithEmail(RegisterWithEmailRequest $request)
    {
        $data = $request->only(['firstname', 'lastname', 'email']);
        $verification_details = $this->createEmailVerificationCode($data, $request);
        $user = $this->auth->registerWithEmail($request, $verification_details);
        Mail::to($user->email)->send(new EmailVerificationCodeMail($verification_details));
        return response()->json(['message' => Config::get('messages.api.register_with_email')]);
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $this->auth->verifyEmail($request);
        return response()->json(['message' => Config::get('messages.api.verify_email')]);
    }
}
