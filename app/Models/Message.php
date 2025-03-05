<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_video',
        'type',
        'is_active'
    ];
}
