<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;

class ServiceController extends Controller
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
        $serviceCategories = ServiceCategory::where(['is_active'=>1])->latest()->get();
        $services = Service::with('service_category')->select('id','service_category_id','title','description','icon_image','image_video','type','is_active')->latest()->get();
        return view('admin.pages.services.service',compact('services','serviceCategories'));
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
            $folder = 'admin/assets/images/service/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/service/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        if ($request->hasFile('icon_image')){
            $width = 80; $height = 80;
            $folder = 'admin/assets/images/service/';
            $data['icon_image'] = $this->services->imageUpload($request->file('icon_image'), $folder,$width,$height);
        }
        $data['service_category_id'] = $request->service_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        Service::create($data);
        return redirect()->route('services.index')->with('message','Service Created Successfully');
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
        $service = Service::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/service/';
            $this->services->imageDestroy($service->image_video,'admin/assets/images/service/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/service/';
            $this->services->imageDestroy($service->image_video,'admin/assets/images/service/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        if ($request->hasFile('icon_image')){
            $width = 80; $height = 80;
            $folder = 'admin/assets/images/service/';
            $data['icon_image'] = $this->services->imageUpload($request->file('icon_image'), $folder,$width,$height);
        }
        $data['service_category_id'] = $request->service_category_id;
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['is_active'] = (int) $request->is_active;
        $service->update($data);
        return redirect()->route('services.index')->with('message','Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        $this->services->imageDestroy($service->image_video,'admin/assets/images/service/');
        $service->delete();
        return redirect()->route('services.index')->with('warning','Service Deleted Successfully');
    }
}
