<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'capital',
        'amount',
        'daily_income',
        'rate',
        'days',
        'start_date',
        'end_date',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
