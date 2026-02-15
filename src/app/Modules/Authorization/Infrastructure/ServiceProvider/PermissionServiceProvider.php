<?php

namespace App\Modules\Authorization\Infrastructure\ServiceProvider;

use App\Modules\Authorization\Application\Permission\Requests\CreatePermissionRequestInterface;
use App\Modules\Authorization\Domain\Repositories\PermissionRepositoryInterface;
use App\Modules\Authorization\Infrastructure\Readers\PermissionReader;
use App\Modules\Authorization\Infrastructure\Repositories\PermissionRepository;
use App\Modules\Authorization\Presentation\Requests\Permission\CreatePermissionRequest;
use App\Shared\Application\Contracts\PermissionReader\PermissionReaderInterface;
use Core\ServiceProvider;
use Illuminate\Container\Container;

final class PermissionServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            CreatePermissionRequestInterface::class,
            CreatePermissionRequest::class
        );

        $container->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );

        $container->bind(
            PermissionReaderInterface::class,
            PermissionReader::class
        );
    }
}