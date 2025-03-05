<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\MissionVision;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::latest()->get();
        $services = Service::with('service_category')->where(['is_active'=>true])->latest()->limit(3)->get();
        $projects = Project::query();
        $testimonials = Testimonial::where(['is_active'=>true])->get();
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.home',compact('sliders','services','projects','testimonials','profiles'));
    }

    public function gallery(){
        $galleries = Gallery::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.gallery',compact('galleries'));
    }

    public function profile(){
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.profile',compact('profiles'));
    }

    public function missionVission(){
        $missionVission = MissionVision::where(['is_active'=>true])->get();
        return view('frontend.pages.mission_vission',compact('missionVission'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            Contact::create($request->all());
            return back()->with('message','Form Submitted Successfully');
        }
        return view('frontend.pages.contactus');
    }

    public function services($id){
        $serciceCategory = ServiceCategory::find($id);
        $services = Service::where(['service_category_id'=>$id,'is_active'=>true])->get();
        return view('frontend.pages.services',compact('services','serciceCategory'));
    }

    public function servicesDetails($id){
        $service = Service::with('service_category')->find($id);
        $services = Service::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.service_details',compact('service','services'));
    }

    public function projects($id){
        $projectCategory = ProjectCategory::find($id);
        $projects = Project::where(['project_category_id'=>$id,'is_active'=>true])->get();
        return view('frontend.pages.projects',compact('projects','projectCategory'));
    }

    public function projectsDetails($id){
        $project = Project::with('project_category')->find($id);
        return view('frontend.pages.project_details',compact('project'));
    }

    public function message(){
        $messages = Message::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.message',compact('messages'));
    }
}
