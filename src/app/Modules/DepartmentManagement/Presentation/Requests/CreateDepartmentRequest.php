<?php

namespace App\Modules\DepartmentManagement\Presentation\Requests;

use App\Modules\DepartmentManagement\Application\Requests\CreateDepartmentRequestInterface;

final class CreateDepartmentRequest implements CreateDepartmentRequestInterface
{
    private string $id;
    private string $name;

    public function __construct()
    {
        $this->id = trim($_POST['id']);
        $this->name = trim($_POST['name']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
