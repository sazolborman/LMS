<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        define('ADMIN', 'layouts.admin.index');
        define('CUSTOMER', 'layouts.customer.index');
        define('GUEST', 'layouts.guest.index');

        View::addNamespace('admin', resource_path('views/admin/'));
        View::addNamespace('customer', resource_path('views/customer'));
        View::addNamespace('guest', resource_path('views/guest'));
    }
}
