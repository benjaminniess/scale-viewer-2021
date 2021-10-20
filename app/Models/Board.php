<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $with = ['numbers'];

    public static function boot()
    {
        parent::boot();

        // Cascade delete for associated content
        self::deleting(function (Board $board): void {
            $board->numbers()->each(function (Number $number): void {
                $number->delete();
            });
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function numbers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Number::class);
    }
}
