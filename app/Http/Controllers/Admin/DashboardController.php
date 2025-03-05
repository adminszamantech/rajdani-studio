<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Models\Project;
use App\Models\Service;
use App\Models\ProjectCategory;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\MissionVision;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function dashboard(){
        $sliderCount = Slider::count();
        $serviceCategoryCount = ServiceCategory::where(['is_active'=>true])->count();
        $serviceCount = Service::where(['is_active'=>true])->count();
        $projectCategoryCount = ProjectCategory::where(['is_active'=>true])->count();
        $projectCount = Project::where(['is_active'=>true])->count();
        $testimonialCount = Testimonial::where(['is_active'=>true])->count();
        $galleryCount = Gallery::where(['is_active'=>true])->count();
        $missionVissionCount = MissionVision::where(['is_active'=>true])->count();
        $messageCount = Message::where(['is_active'=>true])->count();
        $contactCount = Contact::get();
        return view('admin.pages.home.dashboard',compact('sliderCount','serviceCategoryCount','serviceCount','projectCategoryCount','projectCount','testimonialCount','galleryCount','missionVissionCount','messageCount','contactCount'));
    }
}
