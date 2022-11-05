<?php

namespace App\Providers;

use App\Services\UjianService;
use App\Services\Impl\UjianServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UjianServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UjianService::class => UjianServiceImpl::class,
    ];
    public function provides()
    {
        return [
            UjianService::class,
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
