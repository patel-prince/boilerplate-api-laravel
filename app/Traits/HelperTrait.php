<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait HelperTrait
{
    public function createEmailVerificationCode($data, $request)
    {
        $code = Crypt::encrypt([
            'time' => time(),
            'data' => $data
        ]);
        return [
            'url' => ($request->header('origin') ?? "http://localhost:3000") . '/verify/email/' . $code,
            'code' => $code,
            'data' => $data
        ];
    }
}
