<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceService extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'duration',
        'price',
        'service_id',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getPriceDisplayAttribute(): string
    {
        return number_format($this->price);
    }
}
