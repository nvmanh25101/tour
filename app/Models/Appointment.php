<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'message',
        'status',
    ];

    public function time() : BelongsTo
    {
        return $this->belongsTo(Time::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucher() : BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function admin() : BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
