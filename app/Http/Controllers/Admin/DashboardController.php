<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Project;
use App\Models\JobApply;
use App\Models\Testimonial;
use App\Models\MissionVision;
use App\Models\ProjectCategory;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $sliderCount = Slider::count();
        $projectCategoryCount = ProjectCategory::where(['is_active'=>true])->count();
        $projectCount = Project::where(['is_active'=>true])->count();
        $messageCount = Message::where(['is_active'=>true])->count();
        $contactCount = Contact::get();
        return view('admin.pages.home.dashboard',compact('sliderCount','projectCategoryCount','projectCount','messageCount','contactCount'));
    }
}
