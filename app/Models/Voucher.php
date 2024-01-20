<?php

namespace App\Models;

use App\Enums\VoucherStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'uses_per_customer',
        'uses_per_voucher',
        'min_spend',
        'max_spend',
        'applicable_type',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
    ];

    public static function destroy($ids)
    {
        self::where('id', $ids)->update(['status' => VoucherStatusEnum::NGUNG_HOAT_DONG]);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('Y-m-d', strtotime($value)),
        );
    }

    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('Y-m-d', strtotime($value)),
        );
    }

    protected function getstartDateDisplayAttribute(): string
    {
        return date('d-m-Y', strtotime($this->start_date));
    }

    protected function getendDateDisplayAttribute(): string
    {
        return date('d-m-Y', strtotime($this->end_date));
    }
}
