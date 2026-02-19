<?php

namespace App\Modules\QualityAssessment\Infrastructure\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Milestone extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'department_id'];
    public $timestamps = false;

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}