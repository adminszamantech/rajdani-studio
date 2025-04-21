<?php

namespace App\Http\Controllers\Admin;

use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class ProfileController extends Controller
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
        $profiles = Profile::select('id','title','description','image_video','type','is_active')->latest()->get();
        return view('admin.pages.profiles.profile',compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')){
            $folder = 'admin/assets/images/profile/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 700; $height = 500;
            $folder = 'admin/assets/images/profile/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        Profile::create($data);
        return redirect()->route('profiles.index')->with('message','Profile Created Successfully');
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
        $profile = Profile::find($id);
        return view('admin.pages.profiles.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/profile/';
            $this->services->imageDestroy($profile->image_video,'admin/assets/images/profile/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/profile/';
            $this->services->imageDestroy($profile->image_video,'admin/assets/images/profile/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['is_active'] = (int) $request->is_active;
        $profile->update($data);
        return redirect()->route('profiles.index')->with('message','Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = Profile::find($id);
        $this->services->imageDestroy($profile->image_video,'admin/assets/images/profile/');
        $profile->delete();
        return redirect()->route('profiles.index')->with('warning','Profile Deleted Successfully');
    }
}
