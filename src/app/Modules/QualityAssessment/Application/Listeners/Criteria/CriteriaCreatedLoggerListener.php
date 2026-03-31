<?php

namespace App\Modules\QualityAssessment\Application\Listeners\Criteria;

use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaCreated;
use App\Shared\Contracts\Logging\LoggerInterface;

final class CriteriaCreatedLoggerListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(CriteriaCreated $event): void 
    {
        try {
            $this->logger->write(
                'info',
                'create',
                "Người dùng {$event->actor_id} thêm một tiêu chí mới",
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