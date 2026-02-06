<?php

namespace App\Modules\Authentication\Infrastructure\ServiceProvider;

use App\Modules\Authentication\Application\Requests\LoginRequestInterface;
use App\Modules\Authentication\Domain\Repositories\AuthenticableUserRepositoryInterface;
use App\Modules\Authentication\Infrastructure\Repositories\AuthenticableUserRepository;
use App\Modules\Authentication\Presentation\Requests\LoginRequest;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class AuthServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            LoginRequestInterface::class, 
            LoginRequest::class
        );

        $container->bind(
            AuthenticableUserRepositoryInterface::class,
            AuthenticableUserRepository::class
        );
    }
}