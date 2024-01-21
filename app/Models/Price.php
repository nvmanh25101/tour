<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'age_group',
        'price',
        'tour_id',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function getPriceDisplayAttribute(): string
    {
        return number_format($this->price);
    }
}
