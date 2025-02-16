<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TechnicianController extends Controller
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

        $technicians              = Technician::query();
        $technicians              = isset($filter['name']) ? $technicians->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $technicians;
        $technicians              = isset($filter['email']) ? $technicians->where('email', 'LIKE', '%' . $filter['email'] . '%') : $technicians;
        $technicians              = isset($filter['phone']) ? $technicians->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $technicians;       
       

        $technicians              = $technicians->orderBy('id', 'desc')->paginate(20);

        return view('admin.technicians.list', compact('technicians', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
        return view('admin.technicians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [            
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:technicians'],
            'phone'             => ['required', 'min:8', 'unique:technicians'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $technician                       = new Technician();
        $technician->firstname            = $request->firstname;
        $technician->lastname             = $request->lastname;
        $technician->email                = $request->email;
        $technician->email_additional     = $request->email_additional;
        $technician->password             = Hash::make($request->password);
        $technician->dialcode             = $request->dialcode;
        $technician->phone                = $request->phone;
        $technician->gender               = $request->gender;
        $technician->address              = $request->address;
        $technician->city                 = $request->city;
        $technician->state                = $request->state;
        $technician->zipcode              = $request->zipcode;
        $technician->iso2                 = $request->iso2;
        $technician->status               = true;
        $technician->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/technician/', $name, 'public');

            $technician->avatar = $name;
        }

        $technician->save();              
       
        return redirect()->route('admin.technicians.index')->with('success', 'Technician created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $technician          = Technician::find($id);
        $technician->avatar  = isset($technician->avatar) ? asset('storage/uploads/technician/' . $technician->avatar) : URL::to('assets/images/users/avatar.png');
        $technician->country = Country::where('code', $technician->iso2)->first()->name;
        return view('admin.technicians.show', compact('technician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $technician          = Technician::find($id);
        $technician->avatar  = isset($technician->avatar) ? asset('storage/uploads/admin/' . $technician->avatar) : URL::to('assets/images/users/avatar.png');       
        return view('admin.technicians.edit', compact('technician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [            
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:technicians,email,' . $id],
            'phone'             => ['required', 'min:8', 'unique:technicians,phone,' . $id]
        ]);

        $technician                       = Technician::find($id);       
        $technician->firstname            = $request->firstname;
        $technician->lastname             = $request->lastname;
        $technician->email                = $request->email;
        $technician->email_additional     = $request->email_additional;
        $technician->dialcode             = $request->dialcode;
        $technician->phone                = $request->phone;
        $technician->gender               = $request->gender;
        $technician->address              = $request->address;
        $technician->city                 = $request->city;
        $technician->state                = $request->state;
        $technician->zipcode              = $request->zipcode;
        $technician->iso2                 = $request->iso2;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/technician/', $name, 'public');

            if (isset($technician->avatar)) {

                $path   = 'public/uploads/technician/' . $technician->avatar;

                Storage::delete($path);
            }

            $technician->avatar = $name;
        }

        $technician->save();

        return redirect()->route('admin.technicians.index')->with('success', 'Technician updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Technician::find($id)->delete();
        return redirect()->back()->with('success', 'Technician deleted successfully!');
    }

    public function changeStatus($id)
    {
        $technician = Technician::find($id);
        if ($technician->status == true) {
            Technician::find($id)->update(['status' => false]);
            return redirect()->route('admin.technicians.index')->with('warning', 'Technician has been disabled successfully!');
        } else {
            Technician::find($id)->update(['status' => true]);
            return redirect()->route('admin.technicians.index')->with('success', 'Technician has been enabled successfully!');
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        Technician::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Technician password has been reset successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Technician::whereIn('id', $request->technicians)->delete();
        return response()->json(['success' => 'Technicians deleted successfully!'], 200);
    }
      
}
