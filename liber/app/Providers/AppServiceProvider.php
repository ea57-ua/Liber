<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Support\Facades\Dashboard;
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
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );
    }
}
