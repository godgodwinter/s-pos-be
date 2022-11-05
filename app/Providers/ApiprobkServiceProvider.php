<?php

namespace App\Providers;

use App\Services\ApiprobkService;
use App\Services\Impl\ApiprobkServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ApiprobkServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ApiprobkService::class => ApiprobkServiceImpl::class,
    ];
    public function provides()
    {
        return [
            ApiprobkService::class,
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
