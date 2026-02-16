<?php

namespace App\Modules\StaffManagement\Presentation\Requests;

class IndexStaffRequest
{
    private ?string $keyword;

    public function __construct()
    {
        $this->keyword = trim($_GET['search'] ?? '');
    }

    public function getKeyword(): ?string
    {
        return $this->keyword ?? null;
    }
}
