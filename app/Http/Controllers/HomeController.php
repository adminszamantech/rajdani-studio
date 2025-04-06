<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Message;
use App\Models\MissionVision;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;

class HomeController extends Controller
{
    public function home(){
        $sliders = Slider::latest()->get();
        $projectCats = ProjectCategory::where(['is_active'=>true])->get();
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        $messages = Message::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.home',compact('sliders','projectCats','profiles','messages'));
    }

    public function profile(){
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.profile',compact('profiles'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            Contact::create($request->all());
            return back()->with('message','Form Submitted Successfully');
        }
        return view('frontend.pages.contactus');
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

    public function career(){
        return view('frontend.pages.career');
    }
}
