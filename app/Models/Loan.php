<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    const STATUS_WAITING = 1;
    const STATUS_ON_LOAN = 2;
    const STATUS_DONE = 3;

    protected $fillable = [
        'book_id',
        'user_id',
        'quantity',
        'date_of_loan',
        'date_of_return',
        'date_of_return_confirmation',
        'status'
    ];

    protected $casts = [
        'date_of_loan' => 'date',
        'date_of_return' => 'date',
        'date_of_return_confirmation' => 'date',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
