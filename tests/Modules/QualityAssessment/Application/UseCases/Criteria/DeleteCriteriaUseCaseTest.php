<?php

namespace Tests\Unit\Modules\QualityAssessment\Application\UseCases\Criteria;

use App\Modules\QualityAssessment\Application\UseCases\Criteria\DeleteCriteriaUseCase;
use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Repositories\CriteriaRepositoryInterface;
use App\Shared\Contracts\Events\EventDispatcherInterface;
use App\Shared\Contracts\UnitOfWork\UnitOfWorkInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TraitHelper\DebugHelper;

final class DeleteCriteriaUseCaseTest extends TestCase
{
    use DebugHelper;

    private CriteriaRepositoryInterface&MockObject $repository;
    private EventDispatcherInterface&MockObject $eventDispatcher;
    private UnitOfWorkInterface&MockObject $unitOfWork;
    private DeleteCriteriaUseCase $useCase;

    private const VALID_ACTOR_ID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CriteriaRepositoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->unitOfWork = $this->createMock(UnitOfWorkInterface::class);

        $this->unitOfWork->method('execute')->willReturnCallback(fn($callback) => $callback());

        $this->useCase = new DeleteCriteriaUseCase(
            $this->repository,
            $this->eventDispatcher,
            $this->unitOfWork
        );
    }

    public function testDeleteCriteriaSuccessfully(): void
    {
        $id = '1.1';
        $actorId = self::VALID_ACTOR_ID;

        $criteria = $this->createMock(Criteria::class);
        $criteria->method('getId')->willReturn($id);
        $criteria->method('getName')->willReturn('Assessment Criteria');
        $criteria->method('getStandardId')->willReturn('1');

        $this->repository->expects($this->once())
            ->method('findOrFail')
            ->with($id)
            ->willReturn($criteria);

        $this->repository->expects($this->once())
            ->method('delete')
            ->with($criteria);

        $this->eventDispatcher->expects($this->once())->method('dispatch');

        $this->useCase->execute($id, $actorId);

        $this->debug('DELETE CRITERIA SUCCESS', ['id' => $id, 'actor_id' => $actorId]);
    }

    public function testDeleteThrowsExceptionWhenCriteriaNotFound(): void
    {
        $invalidId = '9.9';
        
        $this->repository->method('findOrFail')
            ->with($invalidId)
            ->willThrowException(new \Exception("Criteria not found"));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Criteria not found");

        $this->repository->expects($this->never())->method('delete');
        $this->eventDispatcher->expects($this->never())->method('dispatch');

        $this->useCase->execute($invalidId, self::VALID_ACTOR_ID);
    }
}