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
        'price',
        'service_id',
        'customer_id',
    ];

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}