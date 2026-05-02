<?php

namespace App\Providers;

use App\Services\DeadlineService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use URL;
use View;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // TAMBAHIN ISEXPIRE DI SETIAP VIEW 
        $batasWaktu = DeadlineService::deadline();
        $isExpired = now()->greaterThan($batasWaktu);

        View::share('isExpired', $isExpired);
    }
}
