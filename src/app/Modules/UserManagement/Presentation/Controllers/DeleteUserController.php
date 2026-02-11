<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Application\UseCases\DeleteUserUseCase;
use App\Shared\SessionManager\AuthSession;

class DeleteUserController extends UserController
{
    public function __construct(private DeleteUserUseCase $deleteUserUseCase) {}

    public function destroy(string $id)
    {
        $this->deleteUserUseCase->execute($id, AuthSession::getUserId());
        
        $this->redirect('/users');
    }
}