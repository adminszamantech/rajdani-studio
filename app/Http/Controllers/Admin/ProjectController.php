<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Http\Controllers\Controller;
use App\Models\ProjectImage;

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

        $projects = Project::with('project_category')->select('id','project_category_id','title','description','image_video','type','is_active')->latest()->paginate(20);
        return view('admin.pages.projects.project',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projectCategories = ProjectCategory::where(['is_active'=>1])->latest()->get();
        return view("admin.pages.projects.create",compact('projectCategories'));
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
            $width = 1920; $height = 1080;
            $folder = 'admin/assets/images/project/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }


        $data['project_category_id'] = $request->project_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        $project = Project::create($data);

        if($request->hasFile('project_multi_images')){

            foreach($request->file('project_multi_images') as $file){
                $proImage = new ProjectImage();
                $width = 1920; $height = 1080;
                $folder = 'admin/assets/images/project/';
                $proImage->image = $this->services->imageUpload($file, $folder,$width,$height);
                $proImage->project_id = $project->id ?? 3;
                $proImage->save();
            }
        }
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
        $project = Project::with('project_images')->find($id);
        $projectCategories = ProjectCategory::where(['is_active'=>1])->latest()->get();
        return view("admin.pages.projects.edit",compact('project','projectCategories'));
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
            $width = 1920; $height = 1080;
            $folder = 'admin/assets/images/project/';
            $this->services->imageDestroy($project->image_video,'admin/assets/images/project/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['project_category_id'] = $request->project_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['is_active'] = (int) $request->is_active;
        $project->update($data);



        if($request->hasFile('project_multi_images')){
            // multiple image delete
            $images = ProjectImage::where(['project_id'=>$id])->get();
            foreach($images as $img){
                $this->services->imageDestroy($img->image,'admin/assets/images/project/');
                $img->delete();
            }
            // multiple image add
            foreach($request->file('project_multi_images') as $file){
                $proImage = new ProjectImage();
                $width = 1920; $height = 1080;
                $folder = 'admin/assets/images/project/';
                $proImage->image = $this->services->imageUpload($file, $folder,$width,$height);
                $proImage->project_id = $project->id;
                $proImage->save();
            }
        }

        return redirect()->route('projects.index')->with('message','Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $this->services->imageDestroy($project->image_video,'admin/assets/images/project/');
        $projectImages = ProjectImage::where(['project_id'=>$id])->get();
        foreach($projectImages as $projectImg){
            $this->services->imageDestroy($projectImg->image,'admin/assets/images/project/');
        }
        $project->delete();
        return redirect()->route('projects.index')->with('warning','Project Deleted Successfully');
    }
}
