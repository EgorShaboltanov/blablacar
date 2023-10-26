<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('password_regex', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z0-9]+$/', $value);
        });


        Validator::extend('phone_regex', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\+7[0-9]{10}$/', $value);
        });
      
    }
}
