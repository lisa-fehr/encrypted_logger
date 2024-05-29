<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Concern extends Model
{
    use HasFactory;
    protected $fillable = ['observation_id', 'description', 'photo', 'alternate_date'];

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

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->convert($value),
            set: fn (string $value) => Crypt::encrypt($value)
        );
    }

    protected function convert($value)
    {
        try {
            return Crypt::decrypt($value);
        } catch(DecryptException $e) {
            return $value;
        }
    }

    protected static function booted(): void
    {
        static::creating(function (Concern $concern) {
            $concern->user_id = Auth::user() ? Auth::user()->id : 0;
        });
    }
}
