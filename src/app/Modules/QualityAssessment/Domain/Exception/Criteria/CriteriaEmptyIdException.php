<?php

namespace App\Modules\QualityAssessment\Domain\Exception\Criteria;

use App\Shared\Exception\DomainException;

final class CriteriaEmptyIdException extends DomainException
{
    public function __construct()
    {
        return parent::__construct(
            'Mã tiêu chí không được bỏ trống!', 
            'CRITERIA_ID_EMPTY'
        );
    }
}