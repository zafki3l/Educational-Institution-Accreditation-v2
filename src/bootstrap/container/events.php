<?php

use App\Modules\UserManagement\Application\Listeners\UserCreatedLoggerListener;
use App\Modules\UserManagement\Domain\Events\UserCreated;

return [
    UserCreated::class => [UserCreatedLoggerListener::class]
];