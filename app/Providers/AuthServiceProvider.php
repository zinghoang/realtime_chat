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
        '\App\Model' => 'App\Policies\ModelPolicy',
        '\App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('index-users', function ($user) {
            return $user->level==2;
        });

        Gate::define('show-users', function ($user) {
            return $user->level==2;
        });

        Gate::define('create-users', function ($user) {
            return $user->level==2;
        });

        Gate::define('update-users', function ($user, $user2) {
            return $user->level==2 || $user->id == $user2->id;
        });

        Gate::define('delete-users', function ($user) {
            return $user->level==2;
        });
    }
}
