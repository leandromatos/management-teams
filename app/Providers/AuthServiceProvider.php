<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Team'  => 'App\Policies\TeamPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        // $gate->before(function (User $user) use ($gate) {
        //     // foreach ($this->getPermissions() as $permission) {
        //     //     if ($user->hasPermission($permission)) {
        //     //         return true;
        //     //     }
        //     // }

        //     foreach ($this->getPermissions() as $permission) {
        //         $gate->define($permission->name, function ($user) use ($permission) {
        //             return $user->hasPermission($permission);
        //         });
        //     }
        // });

        // foreach ($this->getPermissions() as $permission) {
        //     $gate->define($permission->name, function ($user) use ($permission) {
        //         return $user->hasPermission($permission);
        //     });
        // }
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
