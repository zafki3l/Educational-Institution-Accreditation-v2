<?php

namespace App\Shared\Contracts\Logging;

interface LoggerInterface
{
    public function write(string $level, string $action, string $message, string $actor_id, array $context): void;
}