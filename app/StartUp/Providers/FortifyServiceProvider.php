<?php

namespace App\StartUp\Providers;

use App\Core\Actions\Auth\AttemptToAuthenticate;
use App\Core\Actions\Auth\CreateNewUser;
use App\Core\Actions\Auth\LogoutResponse;
use App\Core\Actions\Auth\ResetUserPassword;
use App\Core\Actions\Auth\UpdateUserPassword;
use App\Core\Actions\Auth\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Laravel\Fortify\Fortify;

/**
 * Class FortifyServiceProvider
 * @package App\StartUp\Providers
 */
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RedirectIfTwoFactorAuthenticatable::class, AttemptToAuthenticate::class);
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
    }
}
