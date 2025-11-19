<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        //
        // Load web routes (Laravel mặc định đã có)
        $this->loadRoutesFrom(base_path('routes/web.php'));

        // Load api routes
        Route::prefix('api/v1')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
