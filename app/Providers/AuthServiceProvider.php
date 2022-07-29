<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function () {
            if(\Auth::user()->email == 'admin@admin.com'){
                return true;
            }else{
                return false;
            }
        });
        
        Gate::define('guru', function () {
            if(\Auth::user()->email == 'guru@guru.com'){
                return true;
            }else{
                return false;
            }
        });
        
        Gate::define('santri', function () {
            if(\Auth::user()->email == 'santri@santri.com'){
                return true;
            }else{
                return false;
            }
        });
        
        Gate::define('pimpinan', function () {
            if(\Auth::user()->email == 'pimpinan@pimpinan.com'){
                return true;
            }else{
                return false;
            }
        });
    }
}
