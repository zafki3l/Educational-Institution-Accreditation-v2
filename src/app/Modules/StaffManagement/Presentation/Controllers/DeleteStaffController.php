<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Modules\UserManagement\Application\UseCases\DeleteUserUseCase;
use App\Shared\SessionManager\AuthSession;

final class DeleteStaffController extends StaffController
{
    public function __construct(private DeleteUserUseCase $deleteUserUseCase) {}

    public function destroy(string $id)
    {
        $this->deleteUserUseCase->execute($id, AuthSession::getUserId());
        
        $this->redirect('/staffs');
    }
}
