<?php

namespace App\Providers;

use App\Service\Admin\DosenService;
use App\Service\Admin\DosenServiceImplementation;
use App\Service\Admin\KelasService;
use App\Service\Admin\KelasServiceImplementation;
use App\Service\Admin\MahasiswaService;
use App\Service\Admin\MahasiswaServiceImplementation;
use App\Service\Admin\MapelService;
use App\Service\Admin\MapelServiceServiceImplementation;
use App\Service\Dosen\NilaiServiceDosen;
use App\Service\Dosen\NilaiServiceDosenImp;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        MapelService::class => MapelServiceServiceImplementation::class,
        DosenService::class => DosenServiceImplementation::class,
        MahasiswaService::class => MahasiswaServiceImplementation::class,
        KelasService::class => KelasServiceImplementation::class,
        NilaiServiceDosen::class => NilaiServiceDosenImp::class,
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
