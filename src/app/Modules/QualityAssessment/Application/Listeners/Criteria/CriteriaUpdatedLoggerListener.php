<?php

namespace App\Modules\QualityAssessment\Application\Listeners\Criteria;

use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaUpdated;
use App\Shared\Contracts\Logging\LoggerInterface;

final class CriteriaUpdatedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(CriteriaUpdated $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'update',
                "Người dùng {$event->actor_id} sửa tiêu chí {$event->id}",
                $event->actor_id,
                [
                    'criteria_id' => $event->id,
                    'changes' => $event->changes
                ]
            );
        } catch (\Throwable $e) {
        }
    }
}