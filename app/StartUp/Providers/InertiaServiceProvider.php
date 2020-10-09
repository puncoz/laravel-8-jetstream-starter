<?php

namespace App\StartUp\Providers;

use App\Core\Exceptions\InvalidDataSharableClassException;
use App\Core\InertiaData\DataSharableInterface;
use App\Core\InertiaData\RegisterDataSharableClasses;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InertiaServiceProvider
 * @package App\StartUp\Providers
 */
class InertiaServiceProvider extends ServiceProvider
{
    use RegisterDataSharableClasses;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::macro(
            'forceRedirect',
            function (string $url) {
                return response('', Response::HTTP_CONFLICT)->header('x-inertia-location', $url);
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws InvalidDataSharableClassException
     * @throws BindingResolutionException
     */
    public function boot()
    {
        collect($this->dataSharingClasses)->each(
            function (string $dataClass) {
                $class = $this->app->make($dataClass);

                if ( !($class instanceof DataSharableInterface) ) {
                    throw new InvalidDataSharableClassException();
                }

                inertia()->share($class->key(), $class->data());
            }
        );
    }
}
