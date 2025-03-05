<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceCategories = ServiceCategory::latest()->get();
        return view('admin.pages.services.category',compact('serviceCategories'));
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
        $data['name'] = $request->name;
        ServiceCategory::create($data);
        return redirect()->route('service-categories.index')->with('message','Service Category Created Successfully');
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
        $data['name'] = $request->name;
        $data['is_active'] = $request->is_active;
        ServiceCategory::find($id)->update($data);
        return redirect()->route('service-categories.index')->with('message','Service Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ServiceCategory::find($id)->delete();
        // return redirect()->route('service-categories.index')->with('warning','Service Category Deleted Successfully');
    }
}
