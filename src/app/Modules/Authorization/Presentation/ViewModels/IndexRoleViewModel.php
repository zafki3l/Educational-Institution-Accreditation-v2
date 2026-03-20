<?php

namespace App\Modules\Authorization\Presentation\ViewModels;

final class IndexRoleViewModel
{
    public function __construct(
        public readonly int $id, 
        public readonly string $name
    ) {}
}