<?php

use App\Models\WebsiteSetting;

function website(){
    return WebsiteSetting::first();
}
