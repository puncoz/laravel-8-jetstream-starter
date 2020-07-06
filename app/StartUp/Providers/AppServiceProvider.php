<?php

namespace App\StartUp\Providers;

use App\Data\Entities\Media\Media;
use Illuminate\Support\Collection;
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
        // If you're using Laravel Mix, you can
        // use the mix-manifest.json for this.
        inertia()->version(
            function () {
                return md5_file(public_path('assets/back-office/mix-manifest.json'));
            }
        );

        inertia()->setRootView('back.layouts.vue-app');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if(
            'env',
            function ($environment) {
                return app()->environment($environment);
            }
        );
    }
}
