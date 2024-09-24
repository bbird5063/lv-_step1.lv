<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // добавили

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
      //Paginator::defaultView('view-name'); // добавили
      Paginator::defaultView('vendor.pagination.bootstrap-5'); // изменили
    }
}
