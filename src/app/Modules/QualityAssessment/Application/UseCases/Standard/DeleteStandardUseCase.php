<?php

namespace App\Modules\QualityAssessment\Application\UseCases\Standard;

use App\Modules\QualityAssessment\Infrastructure\Models\Standard;

final class DeleteStandardUseCase
{
    public function execute(string $id)
    {
        $standard = Standard::findOrFail($id);

        $standard->delete();
    }
}