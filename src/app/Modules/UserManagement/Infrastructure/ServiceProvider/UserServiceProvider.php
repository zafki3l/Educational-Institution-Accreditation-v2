<?php

namespace App\Modules\UserManagement\Infrastructure\ServiceProvider;

use App\Modules\Role\Infrastructure\Repositories\RoleRepository;
use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;
use App\Modules\UserManagement\Presentation\Requests\CreateUserRequest;
use App\Shared\Contracts\RoleReaderInterface;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class UserServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            RoleReaderInterface::class,
            RoleRepository::class
        );

        $container->bind(
            CreateUserRequestInterface::class,
            CreateUserRequest::class
        );
    }
}