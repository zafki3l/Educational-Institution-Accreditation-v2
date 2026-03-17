<?php

namespace App\Modules\QualityAssessment\Infrastructure\ServiceProvider;

use App\Modules\QualityAssessment\Application\Requests\MilestoneEvidence\CreateMilestoneEvidenceRequestInterface;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneEvidenceRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Repositories\MilestoneEvidenceRepository;
use App\Modules\QualityAssessment\Presentation\Requests\MilestoneEvidence\CreateMilestoneEvidenceRequest;
use Core\ServiceProvider;
use Illuminate\Container\Container;

final class MilestoneEvidenceServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            CreateMilestoneEvidenceRequestInterface::class,
            CreateMilestoneEvidenceRequest::class
        );

        $container->bind(
            MilestoneEvidenceRepositoryInterface::class,
            MilestoneEvidenceRepository::class
        );
    }
}