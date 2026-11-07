<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view): void {
            $settings = array_merge(
                \App\Models\SiteSetting::defaults(),
                \App\Models\SiteSetting::query()->pluck('value', 'key')->all(),
            );
            $view->with('siteSettings', $settings);
        });
    }
}
