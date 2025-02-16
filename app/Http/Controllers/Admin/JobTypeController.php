<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = JobType::paginate(20);
        return view('admin.job-types.list', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.job-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'       => ['required'],
            'description'   => ['required']
        ]);

        $service               = new JobType();
        $service->type         = $request->type;
        $service->description  = $request->description;
        $service->save();

        return redirect()->route('admin.job-types.index')->with('success', 'Job Type created successfully');

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
        $service = JobType::find($id);
        return view('admin.job-types.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'type'       => ['required'],
            'description'   => ['required'],
        ]);

        $service               = JobType::find($id);
        $service->type         = $request->type;
        $service->description  = $request->description;
        $service->save();

        return redirect()->route('admin.job-types.index')->with('success', 'Job Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobType::find($id)->delete();
        return redirect()->route('admin.job-types.index')->with('success', 'Job Type deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        JobType::whereIn('id', $request->job_types)->delete();
        return response()->json(['success' => 'Job Types deleted successfully!'], 200);
    }
}
