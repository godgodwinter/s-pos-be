<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FungsiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/Fungsi.php';
        require_once app_path() . '/Helpers/Fungsi2.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
