<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function($user){
            return $user->role === 'Admin'; 
        });

        Gate::define('siswa', function($user){
            return $user->role === 'Siswa'; 
        });

        Gate::define('guru', function($user){
            return $user->role === 'Guru'; 
        });

        Gate::define('dudi', function($user){
            return $user->role === 'Dudi'; 
        });
    }
}
