<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\CreateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdExistsException;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Domain\Services\CriteriaIdExistsCheckerInterface;
use App\Shared\Logging\LoggerInterface;

final class CreateCriteriaUseCase
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private LoggerInterface $logger,
        private CriteriaIdExistsCheckerInterface $criteriaIdExistsChecker
    ) {}

    public function execute(CreateCriteriaRequestInterface $request, string $actor_id): void
    {
        if ($this->criteriaIdExistsChecker->check($request->getId())) {
            throw new CriteriaIdExistsException();
        }

        $criteria = Criteria::create(
            $request->getId(),
            $request->getStandardId(),
            $request->getName()
        );

        $this->repository->create($criteria);

        $this->writeLog($request, $actor_id);
    }

    public function writeLog(CreateCriteriaRequestInterface $request, string $actor_id): void
    {
        $this->logger->write(
            'info',
            'create', 
            "Người dùng {$actor_id} đã thêm 1 tiêu chí mới", 
            $actor_id, 
            [
                'id' => $request->getId(),
                'name' => $request->getName(),
                'standard_id' => $request->getStandardId()
            ]
        );
    }
}