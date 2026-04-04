<?php

namespace App\Modules\QualityAssessment\Infrastructure\ListenerProvider;

use App\Modules\QualityAssessment\Application\Listeners\Evidence\EvidenceCreatedLoggerListener;
use App\Modules\QualityAssessment\Domain\Events\Evidence\EvidenceCreated;
use Core\ListenerProvider;

final class EvidenceListenerProvider extends ListenerProvider
{
    public static function register(): array
    {
        return [
            EvidenceCreated::class => [EvidenceCreatedLoggerListener::class]
        ];
    }
}