<?php


namespace App\Repositories;


use Laravel\Passport\Client;

class TokenRepository
{
    /**
     * @var Client
     */
    private $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findClientById(int $clientId) {
        return $this->client
            ->newQuery()
            ->findOrFail($clientId);
    }
}
