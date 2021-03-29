<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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
        $this->registerPolicies();
        
        Gate::define('trainer', function ($user) {
            return $user->trainer;
        });

        Gate::define('organizer', function ($user) {
            return $user->type == 2;
        });
        
        Gate::define('owner', function ($user, Model $model) {
            return ($user->trainer || $user->type == 2) && $user->id == $model->user_id;
        });
    }
}
