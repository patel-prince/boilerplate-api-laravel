<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginWithEmailRequest;
use App\Http\Requests\Auth\RegisterWithEmailRequest;
use App\Http\Requests\Auth\SendEmailVerificationCodeRequest;
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

    public function sendEmailVerificationCode(SendEmailVerificationCodeRequest $request)
    {
        $data = $request->only(['email']);
        $user = $this->auth->findByOrFail('email', $data['email']);
        if ($user->email_verified_at == null) {
            $verification_details = $this->createEmailVerificationCode($data, $request);
            $user->email_verification_code = $verification_details['code'];
            $user->save();
            Mail::to($user->email)->send(new EmailVerificationCodeMail($verification_details));
            return response()->json(['notify' => Config::get('messages.api.send_email_verification_code.success')]);
        } else {
            return response()->json(['notify' => Config::get('messages.api.send_email_verification_code.already_verified')], 409);
        }
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $this->auth->verifyEmail($request);
        return response()->json(['message' => Config::get('messages.api.verify_email')]);
    }

    public function loginWithEmail(LoginWithEmailRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['common_errors' => [Config::get('messages.api.login_with_email.unauthorized')]], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        if (empty(auth()->user()->email_verified_at)) {
            return response()->json(['common_errors' => [Config::get('messages.invalid_user')]], 422);
        }
        if (auth()->user()->status != 1) {
            return response()->json(['common_errors' => [Config::get('messages.inactive_user')]], 422);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        return response()->json([
            "user" => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => Config::get('messages.api.logout')]);
    }
}
