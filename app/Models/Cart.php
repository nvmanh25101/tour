<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'quantity',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')->withPivot('quantity');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
