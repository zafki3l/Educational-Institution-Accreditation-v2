<?php

use App\Modules\Authentication\Infrastructure\ListenerProvider\AuthenticationListenerProvider;
use App\Modules\Authorization\Infrastructure\ListenerProvider\RoleListenerProvider;
use App\Modules\UserManagement\Infrastructure\ListenerProvider\UserListenerProvider;

return array_merge(
    UserListenerProvider::register(),
    AuthenticationListenerProvider::register(),
    RoleListenerProvider::register()
);
