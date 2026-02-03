<?php

namespace App\Modules\Role\Presentation\Controllers;

use App\Modules\Role\Application\UseCases\CreateRoleUseCase;
use App\Modules\Role\Application\UseCases\DeleteRoleUseCase;
use App\Modules\Role\Application\UseCases\FindAllRoleUseCase;
use App\Modules\Role\Presentation\Requests\CreateRoleRequest;
use App\Shared\Http\Traits\HttpResponse;
use Core\Controller;

class RoleController extends Controller
{
    use HttpResponse;

    public function __construct(
        private FindAllRoleUseCase $findAllRoleUseCase,
        private CreateRoleUseCase $createRoleUseCase,
        private DeleteRoleUseCase $deleteRoleUseCase
    ) {}

    public function index()
    {
        $roles = $this->findAllRoleUseCase->execute();

        return $this->view('index', 'main.layouts', [
            'title' => 'roles',
            'roles' => $roles
        ]);
    }

    public function store(): void
    {
        $request = new CreateRoleRequest();

        $this->createRoleUseCase
            ->execute($request);

        $this->redirect(ROOT_URL . '/roles');
    }

    public function destroy(int $id): void
    {
        $this->deleteRoleUseCase->execute($id);

        $this->redirect(ROOT_URL . '/roles');
    }
}
