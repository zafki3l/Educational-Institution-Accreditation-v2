<?php

namespace App\Modules\QualityAssessment\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'standard_id', 'name'];
    public $timestamps = false;

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    public function milestone(): HasMany
    {
        return $this->hasMany(Milestone::class, 'criteria_id');
    }
}