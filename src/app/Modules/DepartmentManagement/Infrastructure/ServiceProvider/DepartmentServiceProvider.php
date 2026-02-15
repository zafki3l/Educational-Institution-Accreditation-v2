<?php

namespace App\Modules\DepartmentManagement\Infrastructure\ServiceProvider;

use App\Modules\DepartmentManagement\Infrastructure\Reader\DepartmentReader;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class DepartmentServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            DepartmentReaderInterface::class,
            DepartmentReader::class
        );
    }
}