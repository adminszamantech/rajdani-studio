<?php

use App\Models\Project;
use App\Models\WebsiteSetting;

function website(){
    return WebsiteSetting::first();
}

function cat_wise_projects($catId){
    return Project::where(['project_category_id'=>$catId,'is_active'=>true])->limit(12)->latest()->get();
}

