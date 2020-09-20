<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Campaign;

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

        Gate::define('allow_to_vote_campaign', function(User $user, Campaign $campaign) {
            return $user->id != $campaign->user_id;
        });

        Gate::define('show-user', function(User $user){
            if ($user->permishns->contains('name', 'show-user')){
                return 1;
            }
        });
    }
}
