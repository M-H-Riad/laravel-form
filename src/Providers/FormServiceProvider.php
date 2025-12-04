<?php

namespace Riaad\Form\Providers;

use Illuminate\Support\ServiceProvider;
use Riaad\Form\Support\FormBuilder;

class FormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('form.builder', function () {
            return new FormBuilder();
        });
    }

    public function boot()
    {
        //
    }
}
