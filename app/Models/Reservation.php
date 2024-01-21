<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'admin_id',
        'voucher_id',
        'tour_id',
        'number_people',
        'name_contact',
        'phone_contact',
        'email_contact',
        'price',
        'total_price',
        'departure_date',
        'status',
        'payment_method',
        'payment_status',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function getOrderDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }
}
