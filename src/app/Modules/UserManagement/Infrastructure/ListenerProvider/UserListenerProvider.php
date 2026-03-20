<?php

namespace App\Modules\UserManagement\Infrastructure\ListenerProvider;

use App\Modules\UserManagement\Application\Listeners\UserCreatedLoggerListener;
use App\Modules\UserManagement\Application\Listeners\UserDeletedLoggerListener;
use App\Modules\UserManagement\Application\Listeners\UserUpdatedLoggerListener;
use App\Modules\UserManagement\Domain\Events\UserCreated;
use App\Modules\UserManagement\Domain\Events\UserDeleted;
use App\Modules\UserManagement\Domain\Events\UserUpdated;
use Core\ListenerProvider;

final class UserListenerProvider extends ListenerProvider
{
    public static function register(): array
    {
        return [
            UserCreated::class => [UserCreatedLoggerListener::class],
            UserUpdated::class => [UserUpdatedLoggerListener::class],
            UserDeleted::class => [UserDeletedLoggerListener::class]
        ];
    }
}