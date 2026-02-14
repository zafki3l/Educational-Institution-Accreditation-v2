<?php

namespace App\Modules\UserManagement\Presentation\Controllers;

use App\Modules\UserManagement\Application\UseCases\UpdateUserUseCase;
use App\Modules\UserManagement\Presentation\Requests\UpdateUserRequest;
use App\Shared\Application\Contracts\UserReader\UserReaderInterface;
use App\Shared\Exception\DomainException;
use App\Shared\Response\JsonResponse;
use App\Shared\SessionManager\AuthSession;

final class UpdateUserController extends UserController
{
    public function __construct(
        private UserReaderInterface $userReader,
        private UpdateUserUseCase $updateUserUseCase
    ) {}

    public function edit(string $id): JsonResponse
    {
        $user = $this->userReader->findById($id);

        return new JsonResponse([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email ?? '',
            'role_id' => $user->role_id
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $this->updateUserUseCase->execute($request, AuthSession::getUserId());

            return new JsonResponse([]);
        } catch (DomainException $e) {
            return new JsonResponse([
                'errors' => [$e->getMessage()],
            ], 422);
        }
    }
}