<?php

namespace App\Providers;

use App\Interface\OfferedServiceRepositoryInterface;
use App\Interface\RoleRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Repositories\OfferedServiceRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(OfferedServiceRepositoryInterface::class, OfferedServiceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
