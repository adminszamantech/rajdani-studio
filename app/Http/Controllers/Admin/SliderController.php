<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
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
        $sliders = Slider::latest()->get();
        return view('admin.pages.sliders.slider',compact('sliders'));
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
        if ($request->hasFile('image')){
            $width = 1920; $height = 900;
            $folder = 'admin/assets/images/slider/';
            $data['image'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = ucfirst($request->description);
        $data['button_text'] = $request->button_text;
        $data['button_link'] = $request->button_link;
        Slider::create($data);
        return redirect()->route('sliders.index')->with('message','Slider Created Successfully');
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
        $slider = Slider::find($id);
        if ($request->hasFile('image')){
            $width = 1920; $height = 900;
            $folder = 'admin/assets/images/slider/';
            $this->services->imageDestroy($slider->image,'admin/assets/images/slider/');
            $data['image'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = ucfirst($request->description);
        $data['button_text'] = $request->button_text;
        $data['button_link'] = $request->button_link;
        $slider->update($data);
        return redirect()->route('sliders.index')->with('message','Slider Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        $this->services->imageDestroy($slider->image,'admin/assets/images/slider/');
        $slider->delete();
        return redirect()->route('sliders.index')->with('warning','Slider Deleted Successfully');
    }
}
