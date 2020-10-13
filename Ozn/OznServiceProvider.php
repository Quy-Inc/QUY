<?php
namespace Ozn;

use Illuminate\Support\ServiceProvider;

class OznServiceProvider extends ServiceProvider{
    function register()
    {
        $this->app->bind('ozn', function(){
            return new Ozn;
        });
    }
}