<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'price_include',
        'price_exclude',
        'price_children',
        'note',
        'departure_time',
        'status',
        'duration',
        'vehicle',
        'category_id',
        'admin_id',
    ];

    public static function destroy($ids)
    {
        self::where('id', $ids)->update(['status' => ProductStatusEnum::NGUNG_HOAT_DONG]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Favorite::class, 'favorite_items', 'tour_id', 'favorite_id');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'tour_services', 'tour_id', 'service_id');
    }
    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'destination_tours', 'tour_id', 'destination_id');
    }

    public function reviews(): HasMany
    {
        return $this->HasMany(Review::class);
    }
    public function schedules(): HasMany
    {
        return $this->HasMany(Schedule::class);
    }

    public function getPriceFormatAttribute(): string
    {
        return number_format($this->price);
    }
}
