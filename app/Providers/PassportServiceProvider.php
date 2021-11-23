<?php

namespace App\Providers;

use App\Http\Controllers\Api\V1\BearerTokenResponse;
use Laravel\Passport\Bridge;
use Laravel\Passport\PassportServiceProvider as PassportPassportServiceProvider;
use League\OAuth2\Server\AuthorizationServer;

class PassportServiceProvider extends PassportPassportServiceProvider
{

    public function makeAuthorizationServer()
    {
        return new AuthorizationServer(
            $this->app->make(Bridge\ClientRepository::class),
            $this->app->make(Bridge\AccessTokenRepository::class),
            $this->app->make(Bridge\ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey(),
            new BearerTokenResponse()
        );
    }
}
