<?php

namespace App\Models;

use App\Jobs\QueuedVerifyEmailJob;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'address',
        'district',
        'city',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function favorite(): HasOne
    {
        return $this->hasOne(Favorite::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
