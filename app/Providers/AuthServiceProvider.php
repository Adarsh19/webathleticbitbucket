<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('check-route', function ($user, $permissionSlug) {
            if (isAdmin($user)) {
                return true;
            }

            $menu = \App\Permission::where('route_name', $permissionSlug)->first();

            if (empty($menu)) {
                return true;
            }

            return ($user ?: \Auth::user())->roleDetails->permissions()
                ->where('permission_id', $menu->id)->first() ? true : false;
        });

        Gate::define('check-block', function ($user, $block) {
            if (isAdmin($user)) {
                return true;
            }

            $menu = \App\Permission::where('block_name', $block)->first();

            if (empty($menu)) {
                return true;
            }

            return ($user ?: \Auth::user())->roleDetails->permissions()
                ->where('permission_id', $menu->id)->first() ? true : false;
        });

        $this->registerPolicies();

        //
    }
}
