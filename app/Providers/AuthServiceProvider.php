<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permission;
use App\User;

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

        if ( !app()->runningInConsole() || app()->runningUnitTests() ) {

            Gate::define('owner', function(User $user, $data){
                return $user->id == $data->user_id;
            });

            Gate::define('update_profile', function (User $user, $id){

                return $user->id == $id;
            });

            //Recuperar todas permissions
            $permissions = Permission::all();
            foreach ( $permissions as $permission ) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                        return $user->hasPermission($permission);
                });
            }

            Gate::before(function(User $user, $ability){
                if( $user->hasProfile('Admin') )
                    return true;
            });


        }





    }
}
