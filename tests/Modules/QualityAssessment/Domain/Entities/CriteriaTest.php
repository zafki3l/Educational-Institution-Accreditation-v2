<?php

namespace Tests\Unit\Modules\QualityAssessment\Domain\Entities;

use App\Modules\QualityAssessment\Domain\Entities\Criteria;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyIdException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaEmptyNameException;
use App\Modules\QualityAssessment\Domain\Exception\Criteria\CriteriaIdInvalidFormatException;
use App\Modules\QualityAssessment\Domain\Exception\Standard\StandardEmptyIdException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class CriteriaTest extends TestCase
{
    public function testCreateCriteriaSuccessfully(): void
    {
        $id = '1.5';
        $standardId = '1';
        $name = 'Tiêu chí về chất lượng đào tạo';

        $criteria = Criteria::create($id, $standardId, $name);

        $this->assertInstanceOf(Criteria::class, $criteria);
        $this->assertEquals($id, $criteria->getId());
        $this->assertEquals($standardId, $criteria->getStandardId());
        $this->assertEquals($name, $criteria->getName());
        $this->assertFalse($criteria->hasChanges());
    }

    public function testUpdateCriteriaSuccessfully(): void
    {
        $criteria = Criteria::create('1.1', '1', 'Old name');
        $newName = 'New name updated';

        $criteria->update($newName);

        $this->assertEquals($newName, $criteria->getName());
        $this->assertTrue($criteria->hasChanges());
        
        $changes = $criteria->getChanges();
        $this->assertArrayHasKey('name', $changes);
        $this->assertEquals('Old name', $changes['name']['old']);
        $this->assertEquals($newName, $changes['name']['new']);
    }

    public function testUpdateDoesNotRecordChangesWhenNameIsSame(): void
    {
        $criteria = Criteria::create('1.1', '1', 'Old name');
        $criteria->update('Old name');

        $this->assertFalse($criteria->hasChanges());
    }

    #[DataProvider('invalidFormatProvider')]
    public function testCreateThrowsExceptionWhenIdFormatIsInvalid(string $id, string $standardId): void
    {
        $this->expectException(CriteriaIdInvalidFormatException::class);
        Criteria::create($id, $standardId, 'Name');
    }

    public static function invalidFormatProvider(): array
    {
        return [
            'incorrect_standard_id' => ['2.1', '1'], 
            'missing_dot' => ['11', '1'],
            'not_allowed_zero' => ['1.0', '1'], 
            'contains_characters' => ['1.a', '1'],
            'characters' => ['abc.def', 'abc']
        ];
    }

    #[DataProvider('emptyDataProvider')]
    public function testCreateThrowsExceptionWhenDataIsEmpty(
        string $id, 
        string $standardId, 
        string $name, 
        string $expectedException
    ): void {
        $this->expectException($expectedException);
        Criteria::create($id, $standardId, $name);
    }

    public static function emptyDataProvider(): array
    {
        return [
            'empty_id' => ['', '1', 'Name', CriteriaEmptyIdException::class],
            'empty_standard_id' => ['1.1', '', 'Name', StandardEmptyIdException::class],
            'empty_name' => ['1.1', '1', '', CriteriaEmptyNameException::class],
        ];
    }
}