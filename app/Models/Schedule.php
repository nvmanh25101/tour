<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'activity',
        'description',
        'day',
    ];

    public $timestamps = false;

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
