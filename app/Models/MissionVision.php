<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionVision extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_video',
        'type',
        'mv_type',
        'is_active'
    ];
}
