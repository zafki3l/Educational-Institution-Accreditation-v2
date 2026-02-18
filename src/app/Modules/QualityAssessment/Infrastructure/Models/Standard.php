<?php

namespace App\Modules\QualityAssessment\Infrastructure\Models;

use App\Modules\DepartmentManagement\Infrastructure\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function criteria(): HasMany
    {
        return $this->hasMany(Criteria::class, 'standard_id');
    }
}