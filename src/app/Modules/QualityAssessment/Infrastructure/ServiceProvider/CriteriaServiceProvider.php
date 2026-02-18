<?php

namespace App\Modules\QualityAssessment\Infrastructure\ServiceProvider;

use App\Modules\QualityAssessment\Application\Requests\Criteria\CreateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Domain\Services\CriteriaIdExistsCheckerInterface;
use App\Modules\QualityAssessment\Infrastructure\Repositories\CriteriaRepository;
use App\Modules\QualityAssessment\Infrastructure\Services\CriteriaIdExistsChecker;
use App\Modules\QualityAssessment\Presentation\Requests\Criteria\CreateCriteriaRequest;
use Core\ServiceProvider;
use Illuminate\Container\Container;

class CriteriaServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(
            CreateCriteriaRequestInterface::class,
            CreateCriteriaRequest::class
        );

        $container->bind(
            CriteriaRepositoryInterface::class,
            CriteriaRepository::class
        );

        $container->bind(
            CriteriaIdExistsCheckerInterface::class,
            CriteriaIdExistsChecker::class
        );
    }
}