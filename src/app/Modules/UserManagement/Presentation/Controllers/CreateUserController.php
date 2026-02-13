<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Application\UseCases\CreateUserUseCase;
use App\Modules\UserManagement\Presentation\Requests\CreateUserRequest;
use App\Shared\Application\Contracts\RoleReader\RoleReaderInterface;
use App\Shared\Exception\DomainException;
use App\Shared\Response\ViewResponse;
use App\Shared\SessionManager\AuthSession;

final class CreateUserController extends UserController
{
    public function __construct(
        private RoleReaderInterface $roleReader,
        private CreateUserUseCase $createUserUseCase
    ) {}

    public function create(): ViewResponse
    {
        $roles = $this->roleReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'create/main',
            'main.layouts',
            [
                'title' => 'Thêm người dùng | ' . SYSTEM_NAME,
                'roles' => $roles
            ]
        );
    }

    public function store(CreateUserRequest $request): void
    {
        try {
            $this->createUserUseCase->execute($request, AuthSession::getUserId());

            $this->redirect(ROOT_URL . '/users');
        } catch (DomainException $e) {
            $_SESSION['errors'][] = $e->getMessage();
            
            $_SESSION['old'] = $_POST;
            $_SESSION['open_modal'] = 'create-user';

            $this->back();
        }
    }
}
