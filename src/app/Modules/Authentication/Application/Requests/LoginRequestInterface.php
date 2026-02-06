<?php

namespace App\Modules\Authentication\Application\Requests;

interface LoginRequestInterface
{
    public function getAuthId(): string;

    public function getPassword(): string;
}