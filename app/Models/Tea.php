<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tea extends Model
{
    //
    protected $fillable = [
        'message',
        'rating',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, );
    }
}
