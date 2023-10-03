<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public function concerns(): BelongsToMany
    {
        return $this->belongsToMany(Concern::class, ConcernTag::class);
    }
}
