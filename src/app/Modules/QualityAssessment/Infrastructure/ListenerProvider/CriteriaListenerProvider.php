<?php

namespace App\Modules\QualityAssessment\Infrastructure\ListenerProvider;

use App\Modules\QualityAssessment\Application\Listeners\Criteria\CriteriaCreatedLoggerListener;
use App\Modules\QualityAssessment\Application\Listeners\Criteria\CriteriaDeletedLoggerListener;
use App\Modules\QualityAssessment\Application\Listeners\Criteria\CriteriaUpdatedLoggerListener;
use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaCreated;
use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaDeleted;
use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaUpdated;
use Core\ListenerProvider;

final class CriteriaListenerProvider extends ListenerProvider
{
    public static function register(): array
    {
        return [
            CriteriaCreated::class => [CriteriaCreatedLoggerListener::class],
            CriteriaDeleted::class => [CriteriaDeletedLoggerListener::class],
            CriteriaUpdated::class => [CriteriaUpdatedLoggerListener::class]
        ];
    }
}