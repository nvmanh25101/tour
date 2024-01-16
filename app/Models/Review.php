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
        'reviewable_id',
        'reviewable_type',
        'content',
        'rating',
        'status',
        'reply',
    ];

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
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
