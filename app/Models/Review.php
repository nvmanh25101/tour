<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'admin_id',
        'tour_id',
        'content',
        'rating',
        'status',
        'reply',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::Class, 'tour_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::Class, 'customer_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::Class, 'admin_id');
    }
}
