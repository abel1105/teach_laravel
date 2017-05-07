<?php

namespace App\Providers;


use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Form::macro('test', function($attribute){
            return '<input type="'.$attribute.'">';
        });
    }

    public function register()
    {

    }

}