<?php

namespace App\StartUp\Providers;

use App\Domain\Admin\View\AuthLayout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\StartUp\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        inertia()->version(
            function () {
                return md5_file(public_path('assets/mix-manifest.json'));
            }
        );

        inertia()->setRootView('layouts.app');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::components(
            [
                'auth-layout' => AuthLayout::class,
            ]
        );

        Blade::if(
            'env',
            function ($environment) {
                return app()->environment($environment);
            }
        );
    }
}
