<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Heroes Repositories

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

        // Locations Repositories

        $this->app->bind(
            'App\Repositories\Locations\AreaRepositoryInterface',
            'App\Repositories\Locations\AreaRepository'
        );

        $this->app->bind(
            'App\Repositories\Locations\LocationRepositoryInterface',
            'App\Repositories\Locations\LocationRepository'
        );

        $this->app->bind(
            'App\Repositories\Locations\PlaceRepositoryInterface',
            'App\Repositories\Locations\PlaceRepository'
        );
    }
}
