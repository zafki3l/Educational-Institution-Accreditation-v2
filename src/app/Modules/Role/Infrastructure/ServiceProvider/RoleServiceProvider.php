<?php

namespace App\Modules\Role\Infrastructure\ServiceProvider;

use App\Modules\Role\Application\Requests\CreateRoleRequestInterface;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Role\Infrastructure\Repositories\RoleRepository;
use App\Modules\Role\Presentation\Requests\CreateRoleRequest;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class RoleServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            CreateRoleRequestInterface::class, 
            CreateRoleRequest::class
        );

        $container->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
    }
}