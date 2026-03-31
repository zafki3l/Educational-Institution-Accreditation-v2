<?php

namespace App\Modules\QualityAssessment\Application\Listeners\Criteria;

use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaDeleted;
use App\Shared\Contracts\Logging\LoggerInterface;

final class CriteriaDeletedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(CriteriaDeleted $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'delete',
                "Người dùng {$event->actor_id} xóa tiêu chí {$event->id}",
                $event->actor_id,
                [
                    'criteria_id' => $event->id,
                    'criteria_name' => $event->name,
                    'standard_id' => $event->standard_id
                ]
            );
        } catch (\Throwable $e) {
        }
    }
}