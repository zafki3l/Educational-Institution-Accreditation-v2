<?php

namespace App\Modules\Authentication\Presentation\Requests;

class LoginRequest
{
    private string $auth_id;
    private string $password;

    public function __construct()
    {
        $this->auth_id = $_POST['auth_id'];
        $this->password = $_POST['password'];
    }

    public function getAuthId(): string
    {
        return $this->auth_id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
