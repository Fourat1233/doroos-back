<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;

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
        $this->app['auth']->extend('eloquent', function ($app)
        {
            $model = $app['config']['auth.model'];

            dd($model);

            // $provider = new EloquentUserProvider($app['hash'], $model);

            // return new YourGuard($provider, $this->app['session.store']);
        });

        $this->registerPolicies();

        Passport::routes();
        

        Passport::tokensExpireIn(now()->addDays(15));


        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
