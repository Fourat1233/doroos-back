<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse as ResponseTypesBearerTokenResponse;

class BearerTokenResponse extends ResponseTypesBearerTokenResponse
{
    protected function getExtraParams(AccessTokenEntityInterface $accessToken): array
    {
        $currentUser = User::select('full_name', 'id', 'profile_image', 'contact_point', 'userable_type')
            ->findOrFail($this->accessToken->getUserIdentifier());
        return [
            'current_user' => [
                'id' => $currentUser->id,
                'full_name' => $currentUser->full_name,
                'profile_image' => $currentUser->profile_image,
                'email' => $currentUser->contact_point,
                'user_type' => $currentUser->userable_type,
            ]
        ];
    }
}
