<?php

namespace App\Modules\UserManagement\Presentation\Requests;

use App\Modules\UserManagement\Application\Requests\UpdateUserRequestInterface;

final class UpdateUserRequest implements UpdateUserRequestInterface
{
    private string $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private int $role_id;
    private ?string $department_id;

    public function __construct()
    {
        $this->id = $_POST['id'] ?? $_SESSION['old']['id'] ?? '';
        $this->first_name = $_POST['first_name'] ?? '';
        $this->last_name = $_POST['last_name'] ?? '';
        $this->email = $_POST['email'] ?? '';
        $this->role_id = (int) ($_POST['role_id'] ?? 0);

        if ($this->role_id === 2) {
            $this->department_id = trim($_POST['department_id']);
        } else {
            $this->department_id = null;
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function getDepartmentId(): ?string
    {
        return $this->department_id;
    }
}
