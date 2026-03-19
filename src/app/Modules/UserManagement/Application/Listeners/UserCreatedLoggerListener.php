<?php

namespace App\Modules\UserManagement\Application\Listeners;

use App\Modules\UserManagement\Domain\Events\UserCreated;
use App\Shared\Logging\LoggerInterface;

class UserCreatedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(UserCreated $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'create',
                "Người dùng {$event->actor_id} đã thêm một người dùng mới",
                $event->actor_id,
                ['id' => $event->user->getUserId()->value()]
            );
        } catch (\Throwable $e) {
            error_log("MongoDB is down, skipping log: " . $e->getMessage());
            return;
        }
    }
}