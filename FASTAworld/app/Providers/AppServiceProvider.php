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
        // Adding MIME rule for FASTA
        Validator::extend('fasta', function ($attribute, $value, $parameters, $validator) {
            return strtolower($value->getClientOriginalExtension()) === 'fasta';
        });

        Validator::replacer('fasta', function ($message, $attribute, $rule, $parameters) {
            return 'Only .fasta files are allowed.';
        });
    }
}
