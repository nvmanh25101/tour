<?php

namespace App\Models;

use App\Enums\Category\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
    ];

    public static function destroy($ids)
    {
        self::where('id', $ids)->update(['status' => StatusEnum::NGUNG_HOAT_DONG]);
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
