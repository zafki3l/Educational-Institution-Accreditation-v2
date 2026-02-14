<?php

namespace App\Modules\Authorization\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name'];   
    public $timestamps = false;
}