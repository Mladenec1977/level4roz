<?php

namespace App\Providers;

use App\Repository\Interfaces\PeopleRepositoryInterface;
use App\Repository\PeopleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PeopleRepositoryInterface::class,
            PeopleRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
