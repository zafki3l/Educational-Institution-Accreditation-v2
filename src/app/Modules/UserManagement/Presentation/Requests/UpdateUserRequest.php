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

    public function __construct()
    {
        $this->id = $_POST['id'] ?? $_SESSION['old']['id'] ?? '';
        $this->first_name = $_POST['first_name'] ?? $_SESSION['old']['first_name'] ?? '';
        $this->last_name = $_POST['last_name'] ?? $_SESSION['old']['last_name'] ?? '';
        $this->email = $_POST['email'] ?? $_SESSION['old']['email'] ?? '';
        $this->role_id = (int) ($_POST['role_id'] ?? $_SESSION['old']['role_id'] ?? 0);
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
}
