<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\UserComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Specified key was too long error, Laravel News post:
        Schema::defaultStringLength(191);
        
        View::composer(['users.*'], UserComposer::class);
    
        
    }
}
