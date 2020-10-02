<?php

namespace App\Providers;

use App\Domain\Repositories\Interfaces\IServiceRepository;
use App\Domain\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            IServiceRepository::class,
            ServiceRepository::class
        );
    }
}
