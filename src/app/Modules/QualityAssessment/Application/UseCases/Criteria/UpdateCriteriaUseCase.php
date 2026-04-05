<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\Requests\Criteria\UpdateCriteriaRequestInterface;
use App\Modules\QualityAssessment\Domain\Events\Criteria\CriteriaUpdated;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class UpdateCriteriaUseCase
{
    public function __construct(
        private CriteriaRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(UpdateCriteriaRequestInterface $request, string $actor_id): void
    {
        $criteria = $this->repository->findOrFail($request->getId());

        $criteria->update($request->getName());

        if (!$criteria->hasChanges()) {
            return;
        }
        
        $this->unitOfWork->execute(function () use ($criteria, $actor_id) {
            $this->repository->update($criteria);

            $this->eventDispatcher->dispatch(new CriteriaUpdated(
                $criteria->getId(),
                $criteria->getChanges(),
                $actor_id
            ));
        });
    }
}