<?php

namespace App\Modules\UserManagement\Application\Listeners;

use App\Modules\UserManagement\Domain\Events\UserUpdated;
use App\Shared\Logging\LoggerInterface;

final class UserUpdatedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(UserUpdated $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'update',
                "Người dùng {$event->actor_id} đã sửa thông tin người dùng {$event->user->getUserId()->value()}",
                $event->actor_id,
                ['id' => $event->user->getUserId()->value()]
            );
        } catch (\Throwable $e) {
            error_log("MongoDB is down, skipping log: " . $e->getMessage());
            return;
        }
    }
}