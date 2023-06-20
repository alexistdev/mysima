<?php

namespace App\Providers;

use App\Service\Admin\MapelService;
use App\Service\Admin\MapelServiceServiceImplementation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        MapelService::class => MapelServiceServiceImplementation::class
    ];

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
    }
}
