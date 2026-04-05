<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Standard;

use App\Modules\QualityAssessment\Domain\Entities\Standard;
use App\Modules\QualityAssessment\Domain\Events\Standard\StandardDeleted;
use App\Modules\QualityAssessment\Domain\Repositories\StandardRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;

final class DeleteStandardUseCase
{
    public function __construct(
        private StandardRepositoryInterface $repository,
        private EventDispatcherInterface $eventDispatcher,
        private UnitOfWorkInterface $unitOfWork
    ) {}

    public function execute(string $id, string $actor_id)
    {
        $standard = $this->repository->findOrFail($id);

        if (!$standard) {
            return;
        }
        
        $this->unitOfWork->execute(function () use ($standard, $actor_id) {
            $this->repository->delete($standard);

            $this->eventDispatcher->dispatch(new StandardDeleted(
                $standard->getId(),
                $standard->getName(),
                $standard->getDepartmentId(),
                $actor_id
            ));
        });
    }
}