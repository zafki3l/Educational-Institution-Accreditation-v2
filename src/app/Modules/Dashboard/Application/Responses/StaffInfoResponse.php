<?php

namespace App\Modules\Dashboard\Application\Responses;

final class StaffInfoResponse
{
    public function __construct(
        public readonly string $staff_id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $department_id,
        public readonly string $department_name
    ) {}
}