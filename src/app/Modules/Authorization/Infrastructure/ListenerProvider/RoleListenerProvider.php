<?php

namespace App\Modules\Authorization\Infrastructure\ListenerProvider;

use App\Modules\Authorization\Application\Listeners\RoleCreatedLoggerListener;
use App\Modules\Authorization\Application\Listeners\RoleDeletedLoggerListener;
use App\Modules\Authorization\Application\Listeners\RoleUpdatedLoggerListener;
use App\Modules\Authorization\Domain\Events\RoleCreated;
use App\Modules\Authorization\Domain\Events\RoleDeleted;
use App\Modules\Authorization\Domain\Events\RoleUpdated;
use Core\ListenerProvider;

final class RoleListenerProvider extends ListenerProvider
{
    public static function register(): array
    {
        return [
            RoleCreated::class => [RoleCreatedLoggerListener::class],
            RoleDeleted::class => [RoleDeletedLoggerListener::class],
            RoleUpdated::class => [RoleUpdatedLoggerListener::class]
        ];
    }
}