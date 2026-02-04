<?php

namespace App\Shared\Infrastructure;

use MongoDB\Client;

class MongoDBConnection
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(
            "mongodb://mongo:{$_ENV['MONGO_PORT']}",
            [],
            ['typeMap' => ['root' => 'array', 'document' => 'array']]
        );
    }

    public function getDatabase(string $dbName)
    {
        return $this->client->selectDatabase($dbName);
    }
}