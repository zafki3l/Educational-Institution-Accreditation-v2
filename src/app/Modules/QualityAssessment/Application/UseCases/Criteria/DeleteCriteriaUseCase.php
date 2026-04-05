<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaDeleted;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class DeleteCriteriaUseCase
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(string $id, string $actor_id): void
    {
        $criteria = $this->repository->findOrFail($id);

        $this->unitOfWork->execute(function () use ($criteria, $actor_id) {
            $this->repository->delete($criteria);

            $this->eventDispatcher->dispatch(new CriteriaDeleted(
                $criteria->getId(),
                $criteria->getName(),
                $criteria->getStandardId(),
                $actor_id
            ));
        });
    }
}