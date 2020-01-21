<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('website_url', function($attribute, $value, $parameters)  {
            if($value == ''){
                return true;
            }
            $value = strpos($value, 'http') !== 0 ? "http://$value" : $value;
            $url = str_replace(["ä","ö","ü"], ["ae", "oe", "ue"], $value);
            return filter_var($url, FILTER_VALIDATE_URL);
        }, 'The website url is invalid');
    }
}
