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
        'Fresh\Nashemisto\Article' => 'Fresh\Nashemisto\Policies\ArticlePolicy',
        'Fresh\Nashemisto\Poll' => 'Fresh\Nashemisto\Policies\PollPolicy',
        'Fresh\Nashemisto\Video' => 'Fresh\Nashemisto\Policies\VideoPolicy',
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
            return ($user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('journalist') || $user->hasRole('publicist'));
        });

        Gate::define('USERS_ADMIN', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('UPDATE_TAGS', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });

        Gate::define('UPDATE_ARTICLES', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor') || $user->canDo('UPDATE_ARTICLES');
        });

        Gate::define('UPDATE_PRIORITY', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });

        Gate::define('UPDATE_CATS', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });

        Gate::define('UPDATE_POLLS', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor') || $user->canDo('UPDATE_POLLS');
        });

        Gate::define('CONFIRMATION_DATA', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('journalist'));
        });

        Gate::define('CONFIRMATION_VIDEO', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('video_editor') || $user->hasRole('video_journalist'));
        });

        Gate::define('UPDATE_VIDEO', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('video_editor') || $user->canDo('UPDATE_VIDEO'));
        });


        Gate::define('UPDATE_CHANNEL', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('video_editor'));
        });

        Gate::define('UPDATE_VIEW', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });


        Gate::define('UPDATE_SEO', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });

        Gate::define('UPDATE_STATIC', function ($user) {
            return ($user->hasRole('admin') || $user->hasRole('editor'));
        });
    }
}
