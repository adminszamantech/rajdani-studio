<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobPost;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobApply;

class JobPostController extends Controller
{
    public $services;
    public function __construct(Services $services) {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job_posts = JobPost::with('job_applied')->latest()->limit(20)->get();
        return view('admin.pages.job_posts.lists',compact('job_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function job_applied_status(Request $request)
    {
        if($request->query('status') == 'delete'){
            $jobApplied = JobApply::find($request->query('id'));
            $this->services->imageDestroy($jobApplied->cv,'admin/assets/images/cv/');
            $jobApplied->delete();
            return back()->with('message','Deleted Successfully');
        }else{
            $jobApplied = JobApply::find($request->query('id'));
            $jobApplied->seen = $request->query('status');
            $jobApplied->save();
            return back()->with('message','Status Updated Successfully');
        }
        return back()->with('message','Status Updated Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JobPost::create($request->all());
        return redirect()->route('job-posts.index')->with('message','Job Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function job_applied_lists(JobPost $jobPost)
    {
        $jobApplications = JobApply::where('job_post_id', $jobPost->id)->get();
        $jobAppliedUnseen = $jobApplications->where('seen', 0);
        $jobAppliedSeen = $jobApplications->where('seen', 1);
        $jbApplSrtlstd = $jobApplications->where('seen', 2);
        return view('admin.pages.job_posts.applied_lists',compact('jobPost','jobAppliedUnseen','jobAppliedSeen','jbApplSrtlstd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        JobPost::find($id)->update($request->all());
        return redirect()->route('job-posts.index')->with('message','Job Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobPost = JobPost::with('job_applied')->find($id);
        if($jobPost->job_applied){
            foreach($jobPost->job_applied as $applied){
                $this->services->imageDestroy($applied->cv,'admin/assets/images/cv/');
            }
        }
        $jobPost->delete();
        return redirect()->route('job-posts.index')->with('error','Job Post Deleted Successfully');
    }
}
