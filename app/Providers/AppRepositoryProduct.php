<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
class AppRepositoryProduct extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            ProductRepository::class,
            EloquentProductRepository::class
        );
    }
}
