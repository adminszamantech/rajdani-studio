<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address',
        'logo_image',
        'favicon_image',
        'facebook_link',
        'linkedin_link',
        'whatsapp_number',
    ];
}
