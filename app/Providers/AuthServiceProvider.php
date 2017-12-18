<?php

namespace Fresh\Nashemisto\Providers;

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
        'Fresh\Nashemisto\Model' => 'Fresh\Nashemisto\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function ($user) {
            return $user->canDo();
        });

        Gate::define('USERS_ADMIN', function ($user) {
            return ('admin' === $user->role->name);
        });

        Gate::define('UPDATE_ARTICLES', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('UPDATE_TAGS', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('CONFIRMATION_DATA', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        /*





        Gate::define('UPDATE_MEDICINES_CATS', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('MAIN_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('STATIC_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('SEO_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });*/
    }
}
