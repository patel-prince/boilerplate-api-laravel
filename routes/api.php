<?php

use Illuminate\Support\Facades\Route;

Route::post('register/email', 'AuthController@registerWithEmail');
