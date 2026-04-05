<?php

namespace App\Modules\UserProfile\Application\Listeners;

use App\Modules\UserProfile\Domain\Events\UserProfileUpdated;
use App\Shared\Contracts\Logging\LoggerInterface;

final class UserProfileUpdatedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(UserProfileUpdated $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'update', 
                "Người dùng {$event->actor_id} đã cập nhật hồ sơ cá nhân của mình",
                $event->actor_id,
                [
                    'id' => $event->actor_id,
                    'changes' => $event->changes
                ]
            );
        } catch (\Throwable $e) {
        }
    }
}