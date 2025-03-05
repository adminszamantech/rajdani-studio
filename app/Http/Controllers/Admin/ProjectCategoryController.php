<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectCategories = ProjectCategory::latest()->get();
        return view('admin.pages.projects.category',compact('projectCategories'));
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
        ProjectCategory::create($data);
        return redirect()->route('project-categories.index')->with('message','Project Category Created Successfully');
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
        ProjectCategory::find($id)->update($data);
        return redirect()->route('project-categories.index')->with('message','Project Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ProjectCategory::find($id)->delete();
        // return redirect()->route('project-categories.index')->with('warning','Project Category Deleted Successfully');
    }
}
