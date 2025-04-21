<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_category_id',
        'title',
        'description',
        'image_video',
        'type',
        'is_active'
    ];
    public function project_category(){
        return $this->belongsTo(ProjectCategory::class)->select('id','name','is_active');
    }
    public function project_images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
