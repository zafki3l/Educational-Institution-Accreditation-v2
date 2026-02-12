<?php

namespace App\Modules\UserManagement\Application\Requests;

interface UpdateUserRequestInterface
{
    public function getId(): string;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;

    public function getRoleId(): int;
}