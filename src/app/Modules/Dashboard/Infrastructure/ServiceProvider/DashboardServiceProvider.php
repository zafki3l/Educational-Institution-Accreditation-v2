<?php

namespace App\Modules\Dashboard\Infrastructure\ServiceProvider;

use App\Modules\Dashboard\Application\Readers\AdminDashboardReaderInterface;
use App\Modules\Dashboard\Application\Readers\StaffDashboardReaderInterface;
use App\Modules\Dashboard\Infrastructure\Readers\AdminDashboardReader;
use App\Modules\Dashboard\Infrastructure\Readers\StaffDashboardReader;
use Core\ServiceProvider;
use Illuminate\Container\Container;

final class DashboardServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            AdminDashboardReaderInterface::class,
            AdminDashboardReader::class
        );

        $container->bind(
            StaffDashboardReaderInterface::class,
            StaffDashboardReader::class
        );
    }
}