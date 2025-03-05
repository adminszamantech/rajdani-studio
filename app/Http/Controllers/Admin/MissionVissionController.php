<?php

namespace App\Http\Controllers\Admin;

use App\Services\Services;
use Illuminate\Http\Request;
use App\Models\MissionVision;
use App\Http\Controllers\Controller;

class MissionVissionController extends Controller
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
        $missionVissions = MissionVision::select('id','title','description','image_video','mv_type','type','is_active')->latest()->get();
        return view('admin.pages.mission_vissions.mission_vission',compact('missionVissions'));
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
            $folder = 'admin/assets/images/mission_vission/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/mission_vission/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        $data['mv_type'] = $request->mv_type;
        MissionVision::create($data);
        return redirect()->route('mission-vissions.index')->with('message','Mission Vission Created Successfully');
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
        $missionVissions = MissionVision::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/mission_vission/';
            $this->services->imageDestroy($missionVissions->image_video,'admin/assets/images/mission_vission/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/mission_vission/';
            $this->services->imageDestroy($missionVissions->image_video,'admin/assets/images/mission_vission/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['mv_type'] = $request->mv_type;
        $data['is_active'] = (int) $request->is_active;
        $missionVissions->update($data);
        return redirect()->route('mission-vissions.index')->with('message','Mission Vission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $missionVission = MissionVision::find($id);
        $this->services->imageDestroy($missionVission->image_video,'admin/assets/images/mission_vission/');
        $missionVission->delete();
        return redirect()->route('mission-vissions.index')->with('warning','Mission Vission Deleted Successfully');
    }
}
