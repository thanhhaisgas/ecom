<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\InterfaceProduct;
use App\Repositories\Eloquent\EloquentCheckoutRepository;
use App\Repositories\Contracts\CheckoutRepository;

use App\Repositories\Eloquent\EloquentOrderDetailRepository;
use App\Repositories\Contracts\OrderDetailRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
       // $this->app->singleton(InterfaceProduct::class,ProductRepository::class);
       if ($this->app->environment() == 'local') {
        $this->app->register('Kurt\Repoist\RepoistServiceProvider');
        } 
        $this->app->singleton(CheckoutRepository::Class ,EloquentCheckoutRepository::class );
        $this->app->singleton(OrderDetailRepository::Class ,EloquentOrderDetailRepository::class );
    }
}
