<?php

// namespace App\Providers;

// // use Illuminate\Support\Facades\Gate;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// class AuthServiceProvider extends ServiceProvider
// {
//     /**
//      * The model to policy mappings for the application.
//      *
//      * @var array<class-string, class-string>
//      */
//     protected $policies = [
//         //
//     ];

//     /**
//      * Register any authentication / authorization services.
//      */
//     public function boot(): void
//     {
//         //
//     }
// }

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider
as ServiceProvider;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  

    public function boot(): void
    {
    Gate::before(function ($user, $ability) {

        foreach ($user->claims as $claim) {

            if (
                strtolower(trim($claim['type'] ?? '')) === strtolower($ability)
                && ($claim['allowed'] ?? false) === true
            ) {
                return true;
            }
        }

        return null;
    });
    }
}
