<?php


namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait{


    /**
     *  Grant access token for each grant type passed in parameters
     * @param Request $olderKey
     * @param string $newerKey
     * @param array $credentials
     * @param string $scope
     * @return array
     */
    public function issueToken(
        Request $request, string $grantType,
        array $credentials, string $scope = "*"
    ){

        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => $scope
        ];

        if(isset($credentials['refresh_token'])) {
            $params = array_merge($params, $credentials);
        }else {
            $credentials = $this->replaceArrayKey('contact_point', 'username', $credentials);
            $params = array_merge($params, $credentials);
        }
        
        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }

    /**
     *  
     * @param string $olderKey
     * @param string $newerKey
     * @param array $credentials
     * @return array
     */
    private function replaceArrayKey( string $olderKey, string $newerKey, array $credentials): array {
        $credentials[$newerKey] = & $credentials[$olderKey];
        unset($credentials[$olderKey]);
        return $credentials;
    }
}
