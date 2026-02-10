<?php

namespace App\Shared\Logging;

use App\Shared\Infrastructure\MongoDBConnection;
use MongoDB\Collection;

class MongoLogger implements LoggerInterface
{
    private Collection $collection;

    public function __construct(MongoDBConnection $mongo)
    {
        $this->collection = $mongo->getCollection(
            $_ENV['MONGO_DATABASE'],
            $_ENV['MONGO_COLLECTION']
        );
    }

    public function write(string $level, string $action, string $message, string $actor_id, array $context): void
    {
        $this->collection->insertOne([
            'level' => $level,
            'action' => $action,
            'message' => $message,
            'actor_id' => $actor_id,
            'context' => $context,
            'module' => 'user-management',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
            'time' => new \MongoDB\BSON\UTCDateTime(),
        ]);
    }
}