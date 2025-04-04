<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{


    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isGestionnaire', fn($user) => $user->role === 'gestionnaire');
        Gate::define('isClient', fn($user) => $user->role === 'client');

        Gate::define('isGestionnaire', function ($user) {
            return $user->role === 'gestionnaire';
        });

        Gate::define('isClient', function ($user) {
            return $user->role === 'client';
        });
        //
    }
}
