<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Lead;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter                 = [];
        $filter['name']         = $request->name;
        $filter['email']        = $request->email;
        $filter['phone']        = $request->phone;

        $leads              = Lead::query();
        $leads              = isset($filter['name']) ? $leads->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $leads;
        $leads              = isset($filter['email']) ? $leads->where('email', 'LIKE', '%' . $filter['email'] . '%') : $leads;
        $leads              = isset($filter['phone']) ? $leads->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $leads;


        $leads              = $leads->orderBy('id', 'desc')->paginate(20);

        return view('admin.leads.list', compact('leads', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:leads'],
            'phone'             => ['required', 'min:8', 'unique:leads'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $lead                       = new Lead();
        $lead->company            = $request->company;
        $lead->firstname            = $request->firstname;
        $lead->lastname             = $request->lastname;
        $lead->email                = $request->email;
        $lead->email_additional     = $request->email_additional;
        $lead->password             = Hash::make($request->password);
        $lead->dialcode             = $request->dialcode;
        $lead->phone                = $request->phone;
        $lead->alternate_dialcode    = $request->alternate_dialcode;
        $lead->alternate_phone       = $request->alternate_phone;
        $lead->helpline_dialcode     = $request->helpline_dialcode;
        $lead->helpline_phone        = $request->helpline_phone;
        $lead->fax                = $request->fax;
        $lead->gender               = $request->gender;
        $lead->address              = $request->address;
        $lead->city                 = $request->city;
        $lead->state                = $request->state;
        $lead->zipcode              = $request->zipcode;
        $lead->iso2                 = $request->iso2;
        $lead->remarks                 = $request->remarks;
        $lead->status               = 'Fresh';
        $lead->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/lead/', $name, 'public');

            $lead->avatar = $name;
        }

        $lead->save();

        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead          = Lead::find($id);
        $lead->avatar  = isset($lead->avatar) ? asset('storage/uploads/lead/' . $lead->avatar) : URL::to('assets/images/users/avatar.png');
        $lead->country = Country::where('code', $lead->iso2)->first()->name ?? '';
        return view('admin.leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lead          = Lead::find($id);
        $lead->avatar  = isset($lead->avatar) ? asset('storage/uploads/admin/' . $lead->avatar) : URL::to('assets/images/users/avatar.png');
        return view('admin.leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:leads,email,' . $id],
            'phone'             => ['required', 'min:8', 'unique:leads,phone,' . $id]
        ]);

        $lead                       = Lead::find($id);
        $lead->firstname            = $request->firstname;
        $lead->lastname             = $request->lastname;
        $lead->email                = $request->email;
        $lead->email_additional     = $request->email_additional;
        $lead->dialcode             = $request->dialcode;
        $lead->phone                = $request->phone;
        $lead->alternate_dialcode    = $request->alternate_dialcode;
        $lead->alternate_phone       = $request->alternate_phone;
        $lead->helpline_dialcode     = $request->helpline_dialcode;
        $lead->helpline_phone        = $request->helpline_phone;
        $lead->gender               = $request->gender;
        $lead->address              = $request->address;
        $lead->city                 = $request->city;
        $lead->state                = $request->state;
        $lead->zipcode              = $request->zipcode;
        $lead->iso2                 = $request->iso2;
        $lead->remarks                 = $request->remarks;
        $lead->company                 = $request->company;
        $lead->fax                 = $request->fax;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/lead/', $name, 'public');

            if (isset($lead->avatar)) {

                $path   = 'public/uploads/lead/' . $lead->avatar;

                Storage::delete($path);
            }

            $lead->avatar = $name;
        }

        $lead->save();

        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully!');
    }


    public function convert(string $id)
    {

        $lead                       = Lead::find($id);

        $lead->status = 'Converted';

        $lead->save();

        $supplier                       = new Franchise();
        $supplier->company            = $lead->company;
        $supplier->firstname            = $lead->firstname;
        $supplier->lastname             = $lead->lastname;
        $supplier->email                = $lead->email;
        $supplier->email_additional     = $lead->email_additional;
        $supplier->password             = Hash::make($lead->password);
        $supplier->dialcode             = $lead->dialcode;
        $supplier->phone                = $lead->phone;
        $supplier->alternate_dialcode    = $lead->alternate_dialcode;
        $supplier->alternate_phone       = $lead->alternate_phone;
        $supplier->helpline_dialcode     = $lead->helpline_dialcode;
        $supplier->helpline_phone        = $lead->helpline_phone;
        $supplier->fax                = $lead->fax;
        $supplier->gender               = $lead->gender;
        $supplier->address              = $lead->address;
        $supplier->city                 = $lead->city;
        $supplier->state                = $lead->state;
        $supplier->zipcode              = $lead->zipcode;
        $supplier->iso2                 = $lead->iso2;
        $supplier->remarks                 = $lead->remarks;
        $supplier->status               = true;
        $supplier->email_verified_at    = now();

        $supplier->save();

        return redirect()->route('admin.leads.index')->with('success', 'Lead Conerted to Franchise successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Lead::find($id)->delete();
        return redirect()->back()->with('success', 'Lead deleted successfully!');
    }


    public function updateDate(Request $request)
    {
        $lead = Lead::find($request->id);
        Lead::find($request->id)->update(['next_call_datetime' => $request->datetime]);
        return true;
    }

    public function updateStatus(Request $request)
    {
        $lead = Lead::find($request->lead_id);
        Lead::find($request->lead_id)->update(['status' => $request->status]);
        return 1;
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        Lead::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Lead password has been reset successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Lead::whereIn('id', $request->leads)->delete();
        return response()->json(['success' => 'Leads deleted successfully!'], 200);
    }

}
