<?php

use Illuminate\Support\Facades\Route;

Route::post('register/email', 'AuthController@registerWithEmail');
Route::post('verify-email', 'AuthController@verifyEmail');
