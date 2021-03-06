<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'float'
    ];

    public function board(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}
