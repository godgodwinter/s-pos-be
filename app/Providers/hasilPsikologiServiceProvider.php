<?php

namespace App\Providers;

use App\Services\hasilPsikologiService;
use App\Services\Impl\hasilPsikologiServiceImpl;
use Illuminate\Support\ServiceProvider;

class hasilPsikologiServiceProvider extends ServiceProvider
{
    public array $singletons = [
        hasilPsikologiService::class => hasilPsikologiServiceImpl::class,
    ];
    public function provides()
    {
        return [
            hasilPsikologiService::class,
        ];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
