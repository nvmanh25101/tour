<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_booker',
        'email_booker',
        'phone_booker',
        'number_people',
        'date',
        'duration',
        'price',
        'total_price',
        'note',
        'status',
        'time_id',
        'service_id',
        'customer_id',
        'voucher_id',
        'admin_id',
    ];

    public static function destroy($ids)
    {
        self::where('id', $ids)->update(['status' => AppointmentStatusEnum::TU_CHOI]);
    }

    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getDateDisplayAttribute(): string
    {
        return date('d/m/Y', strtotime($this->date));
    }

    public function getPriceDisplayAttribute(): string
    {
        return number_format($this->price);
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => date('Y-m-d', strtotime($value)),
        );
    }
}
