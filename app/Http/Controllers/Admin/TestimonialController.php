<?php

namespace App\Http\Controllers\Admin;

use App\Services\Services;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::select('id','name','designation','comment','image_video','type','review','is_active')->latest()->get();
        return view('admin.pages.testimonials.testimonial',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')){
            $folder = 'admin/assets/images/testimonial/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/testimonial/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['name'] = $request->name;
        $data['designation'] = ucwords($request->designation);
        $data['comment'] = $request->comment;
        $data['type'] = $request->type;
        $data['review'] = $request->review;
        Testimonial::create($data);
        return redirect()->route('testimonials.index')->with('message','Testimonial Created Successfully');
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
        $testimonial = Testimonial::find($id);
        return view('admin.pages.testimonials.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/testimonial/';
            $this->services->imageDestroy($testimonial->image_video,'admin/assets/images/testimonial/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/testimonial/';
            $this->services->imageDestroy($testimonial->image_video,'admin/assets/images/testimonial/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['name'] = $request->name;
        $data['designation'] = ucwords($request->designation);
        $data['comment'] = $request->comment;
        $data['review'] = $request->review;
        $data['is_active'] = (int) $request->is_active;
        $testimonial->update($data);
        return redirect()->route('testimonials.index')->with('message','Testimonial Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);
        $this->services->imageDestroy($testimonial->image_video,'admin/assets/images/testimonial/');
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('warning','Testimonial Deleted Successfully');
    }
}
