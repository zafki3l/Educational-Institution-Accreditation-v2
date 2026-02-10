<?php

namespace App\Shared\Infrastructure;

use MongoDB\Client;
use MongoDB\Collection;

class MongoDBConnection
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client("mongodb://mongo:{$_ENV['MONGO_PORT']}");
    }

    public function getCollection(string $db, string $collection): Collection
    {
        return $this->client->selectDatabase($db)->selectCollection($collection);
    }
}