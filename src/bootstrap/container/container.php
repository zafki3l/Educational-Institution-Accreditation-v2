<?php

use App\Modules\Role\Application\Requests\CreateRoleRequestInterface;
use App\Modules\Role\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Role\Infrastructure\Repositories\RoleRepository;
use App\Modules\Role\Presentation\Requests\CreateRoleRequest;
use App\Shared\Contracts\RoleReaderInterface;
use App\Shared\Infrastructure\MySQLDatabase;
use Core\App;
use Illuminate\Container\Container;

$container = new Container();

$container->singleton(PDO::class, function () {
    return (new MySQLDatabase())->connect();
});

$container->bind(CreateRoleRequestInterface::class, CreateRoleRequest::class);
$container->bind(RoleRepositoryInterface::class, RoleRepository::class);
$container->bind(RoleReaderInterface::class, RoleRepositoryInterface::class);

App::setContainer($container);