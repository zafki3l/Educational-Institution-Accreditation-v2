<?php

use App\Modules\UserManagement\Application\Listeners\UserCreatedLoggerListener;
use App\Modules\UserManagement\Application\Listeners\UserDeletedLoggerListener;
use App\Modules\UserManagement\Application\Listeners\UserUpdatedLoggerListener;
use App\Modules\UserManagement\Domain\Events\UserCreated;
use App\Modules\UserManagement\Domain\Events\UserDeleted;
use App\Modules\UserManagement\Domain\Events\UserUpdated;

return [
    UserCreated::class => [UserCreatedLoggerListener::class],
    UserUpdated::class => [UserUpdatedLoggerListener::class],
    UserDeleted::class => [UserDeletedLoggerListener::class]
];