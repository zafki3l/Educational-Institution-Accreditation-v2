<?php

use App\Modules\Authentication\Infrastructure\ServiceProvider\AuthServiceProvider;
use App\Modules\Role\Infrastructure\ServiceProvider\RoleServiceProvider;
use App\Modules\UserManagement\Infrastructure\ServiceProvider\UserServiceProvider;

return [
    new AuthServiceProvider(),
    new RoleServiceProvider(),
    new UserServiceProvider()
];