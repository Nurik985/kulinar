<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $menuJson = file_get_contents(base_path('resources/menu/menu.json'));
        $menuData = json_decode($menuJson);

        // Share all menuData to all the views
        \View::share('menuData', [$menuData]);
    }
}
