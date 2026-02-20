<?php

namespace App\Modules\DepartmentManagement\Application\Requests;

interface CreateDepartmentRequestInterface
{
    public function getId(): string;

    public function getName(): string;
}