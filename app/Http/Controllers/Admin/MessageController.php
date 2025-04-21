<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
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
        $messages = Message::select('id','title','description','image_video','type','is_active')->latest()->get();
        return view('admin.pages.messages.message',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')){
            $folder = 'admin/assets/images/message/';
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/message/';
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['type'] = $request->type;
        Message::create($data);
        return redirect()->route('messages.index')->with('message','Message Created Successfully');
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
        $message = Message::find($id);
        return view('admin.pages.messages.edit',compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::find($id);
        if ($request->hasFile('video')){
            $data['type'] = $request->type;
            $folder = 'admin/assets/images/message/';
            $this->services->imageDestroy($message->image_video,'admin/assets/images/message/');
            $data['image_video'] = $this->services->videoUpload($request->file('video'), $folder);
        }
        if ($request->hasFile('image')){
            $data['type'] = $request->type;
            $width = 350; $height = 253;
            $folder = 'admin/assets/images/message/';
            $this->services->imageDestroy($message->image_video,'admin/assets/images/message/');
            $data['image_video'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $data['title'] = ucwords($request->title);
        $data['description'] = $request->description;
        $data['is_active'] = (int) $request->is_active;
        $message->update($data);
        return redirect()->route('messages.index')->with('message','Message Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::find($id);
        $this->services->imageDestroy($message->image_video,'admin/assets/images/message/');
        $message->delete();
        return redirect()->route('messages.index')->with('warning','Message Deleted Successfully');
    }
}
