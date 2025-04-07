<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
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
        $projectCategories = ProjectCategory::where(['is_active'=>1])->latest()->get();
        $projects = Project::with('project_category')->select('id','project_category_id','title','description','image_video','type','is_active')->latest()->paginate(20);
        return view('admin.pages.projects.project',compact('projects','projectCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')){
            $folder = 'admin/assets/images/project/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/project/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['project_category_id'] = $request->project_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        Project::create($data);
        return redirect()->route('projects.index')->with('message','Project Created Successfully');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/project/';
            $this->services->imageDestroy($project->image_video,'admin/assets/images/project/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/project/';
            $this->services->imageDestroy($project->image_video,'admin/assets/images/project/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['project_category_id'] = $request->project_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['is_active'] = (int) $request->is_active;
        $project->update($data);
        return redirect()->route('projects.index')->with('message','Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $this->services->imageDestroy($project->image_video,'admin/assets/images/project/');
        $project->delete();
        return redirect()->route('projects.index')->with('warning','Project Deleted Successfully');
    }
}
