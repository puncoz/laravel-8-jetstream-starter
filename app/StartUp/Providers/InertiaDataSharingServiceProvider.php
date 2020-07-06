<?php

namespace App\StartUp\Providers;

use App\Core\Exceptions\InvalidDataSharedClassException;
use App\Core\InertiaSharedData\DataSharableInterface;
use App\Core\InertiaSharedData\RegisterDataSharableClasses;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

/**
 * Class InertiaDataSharingServiceProvider
 * @package App\StartUp\Providers
 */
class InertiaDataSharingServiceProvider extends ServiceProvider
{
    use RegisterDataSharableClasses;

    /**
     * Bootstrap Inertia Shared Data.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object)[];
            },
        ]);

        collect($this->dataSharingClasses)->each(
            function (string $dataClass) {
                $class = $this->app->make($dataClass);

                if ( !($class instanceof DataSharableInterface) ) {
                    throw new InvalidDataSharedClassException();
                }

                inertia()->share($class->key(), $class->data());
            }
        );
    }
}
