<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['concern_id', 'description', 'img'];

    public function concern(): BelongsTo
    {
        return $this->belongsTo(Concern::class);
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->convert($value)
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
        static::creating(function (Photo $photo) {
            $photo->user_id = Auth::user()->id;
        });
    }
}
