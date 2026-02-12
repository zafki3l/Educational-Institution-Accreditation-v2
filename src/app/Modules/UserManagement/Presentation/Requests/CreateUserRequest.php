<?php

namespace App\Modules\UserManagement\Presentation\Requests;

use App\Modules\UserManagement\Application\Requests\CreateUserRequestInterface;

class CreateUserRequest implements CreateUserRequestInterface
{
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private int $role_id;

    public function __construct() 
    {
        $this->first_name = trim($_POST['first_name']);
        $this->last_name = trim($_POST['last_name']);
        $this->email = trim($_POST['email']);
        $this->password = $_POST['password'];
        $this->role_id = (int) $_POST['role_id'];
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }
}
