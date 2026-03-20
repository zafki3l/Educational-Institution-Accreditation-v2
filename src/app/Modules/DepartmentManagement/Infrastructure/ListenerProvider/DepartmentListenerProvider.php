<?php

namespace App\Modules\DepartmentManagement\Infrastructure\ListenerProvider;

use App\Modules\DepartmentManagement\Application\Listeners\DepartmentCreatedLoggerListener;
use App\Modules\DepartmentManagement\Application\Listeners\DepartmentDeletedLoggerListener;
use App\Modules\DepartmentManagement\Application\Listeners\DepartmentUpdatedLoggerListener;
use App\Modules\DepartmentManagement\Domain\Events\DepartmentCreated;
use App\Modules\DepartmentManagement\Domain\Events\DepartmentDeleted;
use App\Modules\DepartmentManagement\Domain\Events\DepartmentUpdated;
use Core\ListenerProvider;

final class DepartmentListenerProvider extends ListenerProvider
{
    public static function register(): array
    {
        return [
            DepartmentCreated::class => [DepartmentCreatedLoggerListener::class],
            DepartmentDeleted::class => [DepartmentDeletedLoggerListener::class],
            DepartmentUpdated::class => [DepartmentUpdatedLoggerListener::class]
        ];
    }
}