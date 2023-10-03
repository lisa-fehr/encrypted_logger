<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Concern extends Model
{
    use HasFactory;

    public function observation(): BelongsTo
    {
        return $this->belongsTo(Observation::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, ConcernTag::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }
}
