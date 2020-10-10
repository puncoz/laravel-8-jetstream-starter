<?php

namespace App\StartUp\Providers;

use App\Core\Actions\Team\AddTeamMember;
use App\Core\Actions\Team\CreateTeam;
use App\Core\Actions\Team\DeleteTeam;
use App\Core\Actions\Team\UpdateTeamName;
use App\Core\Actions\User\DeleteUser;
use App\Data\Models\Entities\Team;
use App\Data\Models\Entities\TeamUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

/**
 * Class JetstreamServiceProvider
 * @package App\StartUp\Providers
 */
class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Jetstream::useTeamModel(Team::class);
        Jetstream::useMembershipModel(TeamUser::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role(
            'admin',
            __('Administrator'),
            [
                'create',
                'read',
                'update',
                'delete',
            ]
        )->description(__('Administrator users can perform any action.'));

        Jetstream::role(
            'editor',
            __('Editor'),
            [
                'read',
                'create',
                'update',
            ]
        )->description(__('Editor users have the ability to read, create, and update.'));
    }
}
