<?php

namespace App\Modules\Authentication\Application\Listeners;

use App\Modules\Authentication\Domain\Events\UserLoggedIn;
use App\Shared\Logging\LoggerInterface;

final class UserLoggedInLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(UserLoggedIn $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'login',
                "Người dùng {$event->identifier} đã đăng nhập vào hệ thống thành công",
                $event->authenticable_user_id,
                [
                    'id' => $event->authenticable_user_id,
                    'identifier' => $event->identifier
                ]
            );
        } catch (\Throwable $e) {
            error_log("MongoDB is down, skipping log: " . $e->getMessage());
            return;
        }
    }
}