<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status'
    ];

    public function job_applied()
    {
        return $this->hasMany(JobApply::class);
    }
}
