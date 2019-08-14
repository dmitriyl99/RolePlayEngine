<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider 
{
    public function register() 
    {
        $this->app->bind(
            'App\Repositories\HeroRepositoryInterface',
            'App\Repositories\HeroRepository'
        );

        $this->app->bind(
            'App\Repositories\ProfileRepositoryInterface',
            'App\Repositories\ProfileRepository'
        );
    }
}
