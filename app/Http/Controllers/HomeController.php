<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\JobPost;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\JobApply;
use App\Services\Services;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;

class HomeController extends Controller
{
    public $services;
    public function __construct(Services $services) {
        $this->services = $services;
    }
    public function home(){
        $sliders = Slider::latest()->get();
        $projectCats = ProjectCategory::where(['is_active'=>true])->get();
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        $messages = Message::where(['is_active'=>true])->latest()->get();
        $testimonials = Testimonial::where(['is_active'=>true])->get();
        $clients = Client::latest()->get();
        return view('frontend.pages.home',compact('sliders','clients','projectCats','profiles','messages','testimonials'));
    }

    public function profile(){
        $profiles = Profile::where(['is_active'=>true])->latest()->get();
        $messages = Message::where(['is_active'=>true])->latest()->get();
        return view('frontend.pages.profile',compact('profiles','messages'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|regex:/^[0-9+\-\s()]+$/|min:7|max:20',
                'subject' => 'required|string|max:500',
                'message' => 'required|string|max:1000',
            ]);
            Contact::create($validated);
            return back()->with('message','Form Submitted Successfully');
        }
        return view('frontend.pages.contactus');
    }

    public function projects($id){
        $projectCategory = ProjectCategory::find($id);
        if (!$projectCategory) {
            abort(404);
        }
        $projects = Project::where(['project_category_id'=>$id,'is_active'=>true])->latest()->paginate(12);
        return view('frontend.pages.projects',compact('projects','projectCategory'));
    }

    public function projectsDetails($id){
        $project = Project::with('project_category','project_images')->find($id);
        return view('frontend.pages.project_details',compact('project'));
    }

    public function career(){
        $jobPosts = JobPost::latest()->get();
        return view('frontend.pages.career',compact('jobPosts'));
    }

    public function job_post_details(JobPost $jobPost){
        return view('frontend.pages.career_details',compact('jobPost'));
    }

    public function job_apply(Request $request){
        $jobApply = new JobApply;
        $jobApply->job_post_id = $request->job_post_id;
        $jobApply->full_name = $request->full_name;
        $jobApply->email = $request->email;
        $jobApply->phone = $request->phone;
        if ($request->hasFile('cv')){
            $folder = 'admin/assets/images/cv/';
            $jobApply->cv = $this->services->pdfUpload($request->file('cv'), $folder);
        }
        if($request->portfolio_type == 'pdf'){
            $jobApply->portfolio_type = $request->portfolio_type;
            if ($request->hasFile('portfolio')){
                $folder = 'admin/assets/images/portfolio/';
                $jobApply->portfolio = $this->services->pdfUpload($request->file('portfolio'), $folder);
            }
        }
        if($request->portfolio_type == 'link'){
            $jobApply->portfolio_type = $request->portfolio_type;
            $jobApply->portfolio = json_encode($request->portfolio);
        }
        $jobApply->save();
        return back()->with('message','Job Applied Successfully');
    }
}
