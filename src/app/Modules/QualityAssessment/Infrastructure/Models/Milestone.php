<?php

namespace App\Modules\QualityAssessment\Infrastructure\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Milestone extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['id', 'criteria_id', 'code', 'order', 'name'];
    public $timestamps = false;

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(Evidence::class);
    }
}