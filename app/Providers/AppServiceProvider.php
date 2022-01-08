<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->extendValidator();
    }

    public function extendValidator()
    {

        Validator::extend('alpha_space', function ($attribute, $value) {
            return preg_match(Config::get('regex.alpha_space'), $value);
        }, Config::get('messages.validation.alpha_space'));

        Validator::extend('alpha_num_space', function ($attribute, $value) {
            return preg_match(Config::get('regex.alpha_num_space'), $value);
        }, Config::get('messages.validation.alpha_num_space'));

        Validator::extend('password_format', function ($attribute, $value) {
            return preg_match(Config::get('regex.password_format'), $value);
        }, Config::get('messages.validation.password_format'));

    }
}
