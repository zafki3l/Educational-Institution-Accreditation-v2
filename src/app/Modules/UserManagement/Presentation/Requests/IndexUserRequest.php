<?php

namespace App\Modules\UserManagement\Presentation\Requests;

class IndexUserRequest
{
    private ?string $keyword;
    private ?int $role_id;

    public function __construct()
    {
        $this->keyword = isset($_GET['keyword'])
            ? trim($_GET['keyword'])
            : null;

        $this->role_id = isset($_GET['role_id'])
            ? (int) $_GET['role_id']
            : null;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function getRoleId(): ?int
    {
        return $this->role_id;
    }
}