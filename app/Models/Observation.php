<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Observation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'active', 'default', 'started_at', 'ended_at'];

    public function concerns(): HasMany
    {
        return $this->hasMany(Concern::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(

            get: fn (string $value) => $this->convert($value),
            set: fn (string $value) => Crypt::encrypt($value)
        );
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
        static::creating(function (Observation $observation) {
            $observation->user_id = Auth::user()->id;
        });
    }
}
