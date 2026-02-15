<?php

use App\Modules\Authentication\Infrastructure\ServiceProvider\AuthServiceProvider;
use App\Modules\Authorization\Infrastructure\ServiceProvider\PermissionServiceProvider;
use App\Modules\Authorization\Infrastructure\ServiceProvider\RoleServiceProvider;
use App\Modules\DepartmentManagement\Infrastructure\ServiceProvider\DepartmentServiceProvider;
use App\Modules\UserManagement\Infrastructure\ServiceProvider\UserServiceProvider;

return [
    new AuthServiceProvider(),
    new RoleServiceProvider(),
    new UserServiceProvider(),
    new PermissionServiceProvider(),
    new DepartmentServiceProvider()
];