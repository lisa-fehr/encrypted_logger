<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function concerns(): BelongsToMany
    {
        return $this->belongsToMany(Concern::class, ConcernTag::class);
    }

    public function count()
    {
        return $this->concerns()->count();
    }

    protected static function booted(): void
    {
        static::creating(function (Tag $tag) {
            $tag->user_id = Auth::user()->id;
        });
    }
}
