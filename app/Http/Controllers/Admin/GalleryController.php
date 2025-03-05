<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
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
        $galleries = Gallery::select('id','title','description','image_video','type','is_active')->latest()->get();
        return view('admin.pages.galleries.gallery',compact('galleries'));
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
            $folder = 'admin/assets/images/gallery/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/gallery/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = '';
        $data['description'] = '';
        $data['type'] = $request->type;
        Gallery::create($data);
        return redirect()->route('galleries.index')->with('message','Gallery Created Successfully');
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
        $gallery = Gallery::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/gallery/';
            $this->services->imageDestroy($gallery->image_video,'admin/assets/images/gallery/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/gallery/';
            $this->services->imageDestroy($gallery->image_video,'admin/assets/images/gallery/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = '';
        $data['description'] = '';
        $data['is_active'] = (int) $request->is_active;
        $gallery->update($data);
        return redirect()->route('galleries.index')->with('message','Gallery Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);
        $this->services->imageDestroy($gallery->image_video,'admin/assets/images/gallery/');
        $gallery->delete();
        return redirect()->route('galleries.index')->with('warning','Gallery Deleted Successfully');
    }
}
