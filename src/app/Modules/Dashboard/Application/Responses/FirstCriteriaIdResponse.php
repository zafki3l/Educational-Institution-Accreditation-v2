<?php

namespace App\Modules\Dashboard\Application\Responses;

final class FirstCriteriaIdResponse
{
    public function __construct(public readonly string $first_criteria_id) {}
}