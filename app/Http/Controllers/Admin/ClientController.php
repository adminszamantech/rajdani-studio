<?php

namespace App\Http\Controllers\Admin;


use App\Models\Client;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
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
        $clients = Client::latest()->get();
        return view('admin.pages.clients.client',compact('clients'));
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
            $width = 276; $height = 60;
            $folder = 'frontend/img/client/';
            $data['image'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        Client::create($data);
        return redirect()->route('clients.index')->with('message','Client Created Successfully');
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
        $client = Client::find($id);
        if ($request->hasFile('image')){
            $width = 276; $height = 60;
            $folder = 'frontend/img/client/';
            $this->services->imageDestroy($client->image,'frontend/img/client/');
            $data['image'] = $this->services->imageUpload($request->file('image'), $folder,$width,$height);
        }
        $client->update($data);
        return redirect()->route('clients.index')->with('message','Client Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        $this->services->imageDestroy($client->image,'frontend/img/client/');
        $client->delete();
        return redirect()->route('clients.index')->with('warning','Client Deleted Successfully');
    }
}
