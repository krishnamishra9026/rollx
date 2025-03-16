<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FranchiseController extends Controller
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

        $franchises              = Franchise::query();
        $franchises              = isset($filter['name']) ? $franchises->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $franchises;
        $franchises              = isset($filter['email']) ? $franchises->where('email', 'LIKE', '%' . $filter['email'] . '%') : $franchises;
        $franchises              = isset($filter['phone']) ? $franchises->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $franchises;


        $franchises              = $franchises->orderBy('id', 'desc')->paginate(20);

        return view('admin.franchises.list', compact('franchises', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.franchises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:franchises'],
            'phone'             => ['required', 'min:8', 'unique:franchises'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $supplier                       = new Franchise();
        $supplier->company            = $request->company;
        $supplier->firstname            = $request->firstname;
        $supplier->lastname             = $request->lastname;
        $supplier->email                = $request->email;
        $supplier->email_additional     = $request->email_additional;
        $supplier->password             = Hash::make($request->password);
        $supplier->dialcode             = $request->dialcode;
        $supplier->phone                = $request->phone;
        $supplier->alternate_dialcode    = $request->alternate_dialcode;
        $supplier->alternate_phone       = $request->alternate_phone;
        $supplier->helpline_dialcode     = $request->helpline_dialcode;
        $supplier->helpline_phone        = $request->helpline_phone;
        $supplier->fax                = $request->fax;
        $supplier->gender               = $request->gender;
        $supplier->address              = $request->address;
        $supplier->city                 = $request->city;
        $supplier->state                = $request->state;
        $supplier->zipcode              = $request->zipcode;
        $supplier->iso2                 = $request->iso2;
        $supplier->remarks                 = $request->remarks;
        $supplier->status               = true;
        $supplier->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/supplier/', $name, 'public');

            $supplier->avatar = $name;
        }

        $supplier->save();

        return redirect()->route('admin.franchises.index')->with('success', 'Franchise created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $franchise          = Franchise::find($id);
        $franchise->avatar  = isset($franchise->avatar) ? asset('storage/uploads/franchise/' . $franchise->avatar) : URL::to('assets/images/users/avatar.png');
        $franchise->country = Country::where('code', $franchise->iso2)->first()->name ?? '';
        return view('admin.franchises.show', compact('franchise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $franchise          = Franchise::find($id);
        $franchise->avatar  = isset($franchise->avatar) ? asset('storage/uploads/admin/' . $franchise->avatar) : URL::to('assets/images/users/avatar.png');
        return view('admin.franchises.edit', compact('franchise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:franchises,email,' . $id],
            'phone'             => ['required', 'min:8', 'unique:franchises,phone,' . $id]
        ]);

        $supplier                       = Franchise::find($id);
        $supplier->firstname            = $request->firstname;
        $supplier->lastname             = $request->lastname;
        $supplier->email                = $request->email;
        $supplier->email_additional     = $request->email_additional;
        $supplier->dialcode             = $request->dialcode;
        $supplier->phone                = $request->phone;
        $supplier->alternate_dialcode    = $request->alternate_dialcode;
        $supplier->alternate_phone       = $request->alternate_phone;
        $supplier->helpline_dialcode     = $request->helpline_dialcode;
        $supplier->helpline_phone        = $request->helpline_phone;
        $supplier->gender               = $request->gender;
        $supplier->address              = $request->address;
        $supplier->city                 = $request->city;
        $supplier->state                = $request->state;
        $supplier->zipcode              = $request->zipcode;
        $supplier->iso2                 = $request->iso2;
        $supplier->remarks                 = $request->remarks;
        $supplier->company                 = $request->company;
        $supplier->fax                 = $request->fax;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/supplier/', $name, 'public');

            if (isset($supplier->avatar)) {

                $path   = 'public/uploads/supplier/' . $supplier->avatar;

                Storage::delete($path);
            }

            $supplier->avatar = $name;
        }

        $supplier->save();

        return redirect()->route('admin.franchises.index')->with('success', 'Franchise updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {              
        $franchise = Franchise::find($id);

        if (!$franchise) {
            return back()->with('error', 'Franchise not found.');
        }

        $issues = [];

        if ($franchise->orders()->exists()) {
            $issues[] = 'Franchise is linked to orders.';
        }
        if ($franchise->sales()->exists()) {
            $issues[] = 'Franchise has sales records.';
        }
        if ($franchise->productPrices()->exists()) {
            $issues[] = 'Franchise has franchise price records.';
        }
        if ($franchise->plate_settings()->exists()) {
            $issues[] = 'Franchise is assigned to a product plate setting.';
        }              

        if (!empty($issues)) {
            return back()->with('error_list', $issues);
        }

        Franchise::find($id)->delete();
        return redirect()->back()->with('success', 'Franchise deleted successfully!');
    }

    public function changeStatus($id)
    {
        $supplier = Franchise::find($id);
        if ($supplier->status == true) {
            Franchise::find($id)->update(['status' => false]);
            return redirect()->route('admin.franchises.index')->with('warning', 'Franchise has been disabled successfully!');
        } else {
            Franchise::find($id)->update(['status' => true]);
            return redirect()->route('admin.franchises.index')->with('success', 'Franchise has been enabled successfully!');
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        Franchise::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Franchise password has been reset successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Franchise::whereIn('id', $request->franchises)->delete();
        return response()->json(['success' => 'Franchises deleted successfully!'], 200);
    }

}
