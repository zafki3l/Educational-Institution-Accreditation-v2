<?php

namespace App\Modules\Role\Presentation\Requests;

use App\Modules\Role\Application\Requests\CreateRoleRequestInterface;

final class CreateRoleRequest implements CreateRoleRequestInterface
{
    private string $name;

    public function __construct()
    {
        $this->name = trim($_POST['name'] ?? '');
    }

    public function getName(): string {return $this->name;}
}