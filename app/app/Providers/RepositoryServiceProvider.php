<?php

namespace App\Providers;

use App\Domain\Repositories\PhoneLineRepository;
use App\Domain\Repositories\RepositoryInterfaces\IPhoneLineRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->app->bind(
        //     Interface::class,
        //     ConcreteClass::class
        // );
    }
}