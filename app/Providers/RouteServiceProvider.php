<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        Route::middleware('web')
            ->namespace($this->namespace)
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));


        Route::middleware('web')
            ->group(base_path('routes/guest.php'));
    }
}
