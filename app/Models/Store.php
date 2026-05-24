<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $fillable = [
        'area_id',
        'name',
        'code',
        'is_active',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
}
