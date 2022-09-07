<?php

namespace App\Providers;

use App\Services\Api\OrderService;
use App\Services\Api\ProductService;
use App\Repositories\Api\UserRepository;
use App\Repositories\Api\OrderRepository;
use App\Repositories\Api\ProductRepository;
use App\Contracts\Services\Api\OrderServiceContract;
use App\Contracts\Services\Api\ProductServiceContract;
use App\Contracts\Repositories\Api\UserRepositoryContract;
use App\Contracts\Repositories\Api\OrderRepositoryContract;
use App\Contracts\Repositories\Api\ProductRepositoryContract;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerRepositories()
    {
        $this->app->singleton(UserRepositoryContract::class, UserRepository::class);
        $this->app->singleton(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->singleton(ProductRepositoryContract::class, ProductRepository::class);
    }

    private function registerServices()
    {
        $this->app->singleton(OrderServiceContract::class, OrderService::class);
        $this->app->singleton(ProductServiceContract::class, ProductService::class);
    }

    public function boot()
    {
        //
    }
}
