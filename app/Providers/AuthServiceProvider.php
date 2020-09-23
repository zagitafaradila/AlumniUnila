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

        Gate::define('isAdministrator', function($user){
            return $user->access == 'Administrator';
        });

        Gate::define('isKPS', function($user){
            return $user->access == 'KPS';
        });

        Gate::define('isSurveyor', function($user){
            return $user->access == 'Surveyor';
        });

        Gate::define('isAlumni', function($user){
            $akses = $user->access;
            if($akses == 'Surveyor' || $akses == 'Alumni'){
                return $akses;
            }
        });

        //
    }
}
