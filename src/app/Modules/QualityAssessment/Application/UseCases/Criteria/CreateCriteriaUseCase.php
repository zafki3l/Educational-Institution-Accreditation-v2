<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\CreateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaCreated;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdExistsException;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Modules\QualityAssessment\Domain\Services\CriteriaIdExistsCheckerInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class CreateCriteriaUseCase
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private CriteriaIdExistsCheckerInterface $criteriaIdExistsChecker,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
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

        $this->unitOfWork->execute(function () use ($criteria, $actor_id) {
            $this->repository->create($criteria);

            $this->eventDispatcher->dispatch(new CriteriaCreated(
                $criteria->getId(),
                $criteria->getName(),
                $criteria->getStandardId(),
                $actor_id
            ));
        });
    }
}