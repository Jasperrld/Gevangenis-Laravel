<?php

namespace App\Providers;

use App\Models\Prisoner;
use App\Observers\PrisonerObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength( length: 191);
        Prisoner::observe(PrisonerObserver::class);

    }
}
