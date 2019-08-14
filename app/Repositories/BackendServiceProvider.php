<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider 
{
    public function register() 
    {
        $this->app->bind(
            'App\Repositories\Heroes\HeroRepositoryInterface',
            'App\Repositories\Heroes\HeroRepository'
        );

        $this->app->bind(
            'App\Repositories\Heroes\ProfileRepositoryInterface',
            'App\Repositories\Heroes\ProfileRepository'
        );

        $this->app->bind(
            'App\Repositories\Heroes\PdaRepositoryInterface',
            'App\Repositories\Heroes\PdaRepository'
        );
    }
}
