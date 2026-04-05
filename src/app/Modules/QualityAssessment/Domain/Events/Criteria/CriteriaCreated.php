<?php

namespace App\Modules\QualityAssessment\Domain\Events\Criteria;

final class CriteriaCreated
{
    public function __construct(
       public readonly string $id,
       public readonly string $name,
       public readonly string $standard_id,
       public readonly string $actor_id 
    ) {}
}