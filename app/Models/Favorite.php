<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'customer_id',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'favorite_items', 'favorite_id', 'tour_id');
    }

}
