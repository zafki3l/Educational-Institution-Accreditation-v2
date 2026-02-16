<?php

namespace App\Modules\StaffManagement\Presentation\Controllers;

use App\Modules\StaffManagement\Presentation\Requests\CreateStaffRequest;
use App\Modules\UserManagement\Application\UseCases\CreateUserUseCase;
use App\Shared\Application\Contracts\DepartmentReader\DepartmentReaderInterface;
use App\Shared\Exception\DomainException;
use App\Shared\Response\JsonResponse;
use App\Shared\Response\ViewResponse;
use App\Shared\SessionManager\AuthSession;

final class CreateStaffController extends StaffController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private DepartmentReaderInterface $departmentReader
    ) {}

    public function create(): ViewResponse
    {
        $departments = $this->departmentReader->all();

        return new ViewResponse(
            self::MODULE_NAME,
            'create/main',
            'main.layouts',
            [
                'title' => 'Thêm nhân viên | ' . SYSTEM_NAME,
                'departments' => $departments
            ]
        );
    }

    public function store(CreateStaffRequest $request): JsonResponse
    {
        try {
            $this->createUserUseCase->execute($request, AuthSession::getUserId());

            return new JsonResponse([], 200);
        } catch (DomainException $e) {
            return new JsonResponse([
                'errors' => [$e->getMessage()]
            ], 422);
        }
    }
}
