<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'contact',
        'is_approved',
        'is_deleted',
        'attachment_path',
        'duration_days',
        'is_active',
        'expires_at',
        'url'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];
}
