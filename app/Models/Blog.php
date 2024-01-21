<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'admin_id',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getCreatedDateAttribute(): string
    {
        return date('d-m-Y H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedDateAttribute(): string
    {
        return date('d-m-Y H:i:s', strtotime($this->updated_at));
    }
}
