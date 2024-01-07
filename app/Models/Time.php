<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Time extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'time',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getTimeDisplayAttribute(): string
    {
        return date('H:i', strtotime($this->time));
    }
}
