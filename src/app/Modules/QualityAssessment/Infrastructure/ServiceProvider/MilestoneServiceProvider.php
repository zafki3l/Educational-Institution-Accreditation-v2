<?php

namespace App\Modules\QualityAssessment\Infrastructure\ServiceProvider;

use App\Modules\QualityAssessment\Application\Requests\Milestone\CreateMilestoneRequestInterface;
use App\Modules\QualityAssessment\Domain\Repositories\MilestoneRepositoryInterface;
use App\Modules\QualityAssessment\Infrastructure\Repositories\MilestoneRepository;
use App\Modules\QualityAssessment\Presentation\Requests\Milestone\CreateMilestoneRequest;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class MilestoneServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            CreateMilestoneRequestInterface::class,
            CreateMilestoneRequest::class
        );

        $container->bind(
            MilestoneRepositoryInterface::class,
            MilestoneRepository::class
        );
    }
}