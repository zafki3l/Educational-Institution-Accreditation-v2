<?php

namespace App\Modules\QualityAssessment\Infrastructure\Models;

use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Standard extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'department_id'];
    public $timestamps = false;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}