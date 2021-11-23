<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-ingr', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('register-user', function($user){
            return $user->hasAnyRole(['admin']);
        });

        Gate::define('edit-user', function($user){
            return $user->hasAnyRole(['admin']);
        });

        Gate::define('manage-users', function($user){
            return $user->hasAnyRole(['admin']);
        });

        Gate::define('manage-product', function($user){
            return $user->hasAnyRole(['admin']);
        });

        Gate::define('manage-sale', function($user){
            return $user->hasAnyRole(['admin']);
        });

#
    }
}
