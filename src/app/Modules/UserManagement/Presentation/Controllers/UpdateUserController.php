<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Infrastructure\Readers\UserReader;
use App\Shared\Response\JsonResponse;

final class UpdateUserController extends UserController
{
    public function __construct(private UserReader $userReader) {}
    public function edit(string $id)
    {
        $user = $this->userReader->findById($id);

        return new JsonResponse([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'role_id' => $user->role_id
        ]);
    }

    public function update()
    {
        echo "hi {$_POST['id']}";
    }
}