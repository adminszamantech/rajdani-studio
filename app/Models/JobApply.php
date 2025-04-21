<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'cv',
        'portfolio',
        'portfolio_type',
        'seen'
    ];
}
