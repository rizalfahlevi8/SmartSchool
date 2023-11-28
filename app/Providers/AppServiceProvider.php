<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        // Validator::extend('max_words', function ($attribute, $value, $parameters, $validator, $name) {
        //     $maxWords = (string) $parameters[0];
        //     $wordCount = str_word_count($value);
        //     return $wordCount <= $maxWords;
        // });
    }
}
