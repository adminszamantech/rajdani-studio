<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'title',
        'description',
        'icon_image',
        'image_video',
        'type',
        'is_active'
    ];
    public function service_category(){
        return $this->belongsTo(ServiceCategory::class)->select('id','name','is_active');
    }
}
