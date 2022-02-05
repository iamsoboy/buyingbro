<?php

namespace App\Providers;

use App\UserWithdraw;
use App\Policies\WithdrawsPolicy;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    /*protected $policies = [
        // 
        'App\Model' => 'App\Policies\WithdrawsPolicy',
        'App\UserWithdraw' => 'App\Policies\WithdrawsPolicy',
    ]; */

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
