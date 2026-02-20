<?php

namespace App\Modules\UserManagement\Application\Requests;

interface CreateUserRequestInterface
{    
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;

    public function getPassword(): string;

    public function getRoleId(): int;

    public function getDepartmentId(): ?string;
}