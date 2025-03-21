<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inquiry;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $filter                 = [];
        $filter['name']         = $request->name;
        $filter['email']        = $request->email;
        $filter['phone']        = $request->phone;

        $inquiries              = Inquiry::query();

        $inquiries              = isset($filter['name']) ? $inquiries->where('name', 'LIKE', '%' . $filter['name'] . '%') : $inquiries;
        $inquiries              = isset($filter['email']) ? $inquiries->where('email', 'LIKE', '%' . $filter['email'] . '%') : $inquiries;
        $inquiries              = isset($filter['phone']) ? $inquiries->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $inquiries;


        $inquiries              = $inquiries->orderBy('id', 'desc')->paginate(20);

        return view('admin.inquiries.list', compact('inquiries', 'filter'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inquiry = Inquiry::find($id);
        return view('admin.inquiries.show', compact('inquiry'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
