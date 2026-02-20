<?php

namespace App\Modules\Authorization\Presentation\Requests\Role;

use App\Modules\Authorization\Application\Role\Requests\CreateRoleRequestInterface;

final class CreateRoleRequest implements CreateRoleRequestInterface
{
    private string $name;

    public function __construct()
    {
        $this->name = trim($_POST['name'] ?? '');
    }

    public function getName(): string {return $this->name;}
}