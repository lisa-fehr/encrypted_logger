<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Observation extends Model
{
    use HasFactory;

    public function concerns(): HasMany
    {
        return $this->hasMany(Concern::class);
    }
}
