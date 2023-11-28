<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Validator;
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7

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
<<<<<<< HEAD
        //
=======
        // Validator::extend('max_words', function ($attribute, $value, $parameters, $validator, $name) {
        //     $maxWords = (string) $parameters[0];
        //     $wordCount = str_word_count($value);
        //     return $wordCount <= $maxWords;
        // });
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
    }
}
