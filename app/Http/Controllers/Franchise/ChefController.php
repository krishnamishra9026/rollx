<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:franchise');
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

        $chefs              = Chef::query();
        $chefs              = isset($filter['name']) ? $chefs->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $chefs;
        $chefs              = isset($filter['email']) ? $chefs->where('email', 'LIKE', '%' . $filter['email'] . '%') : $chefs;
        $chefs              = isset($filter['phone']) ? $chefs->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $chefs;       
       

        $chefs              = $chefs->orderBy('id', 'desc')->paginate(20);

        return view('franchise.chefs.list', compact('chefs', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
        return view('franchise.chefs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [            
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:chefs'],
            'phone'             => ['required', 'min:8', 'unique:chefs'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $chef                       = new Chef();
        $chef->firstname            = $request->firstname;
        $chef->franchise_id               = auth()->user()->id;
        $chef->lastname             = $request->lastname;
        $chef->email                = $request->email;
        $chef->email_additional     = $request->email_additional;
        $chef->password             = Hash::make($request->password);
        $chef->dialcode             = $request->dialcode;
        $chef->phone                = $request->phone;
        $chef->gender               = $request->gender;
        $chef->address              = $request->address;
        $chef->city                 = $request->city;
        $chef->state                = $request->state;
        $chef->zipcode              = $request->zipcode;
        $chef->iso2                 = $request->iso2;
        $chef->status               = true;
        $chef->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/technician/', $name, 'public');

            $chef->avatar = $name;
        }

        $chef->save();              
       
        return redirect()->route('franchise.chefs.index')->with('success', 'Chef created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chef          = Chef::find($id);
        $chef->avatar  = isset($chef->avatar) ? asset('storage/uploads/technician/' . $chef->avatar) : URL::to('assets/images/users/avatar.png');
        $chef->country = Country::where('code', $chef->iso2)->first()->name;
        return view('franchise.chefs.show', compact('technician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chef          = Chef::find($id);
        $chef->avatar  = isset($chef->avatar) ? asset('storage/uploads/admin/' . $chef->avatar) : URL::to('assets/images/users/avatar.png');       
        return view('franchise.chefs.edit', compact('technician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [            
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:chefs,email,' . $id],
            'phone'             => ['required', 'min:8', 'unique:chefs,phone,' . $id]
        ]);

        $chef                       = Chef::find($id);       
        $chef->firstname            = $request->firstname;
        $chef->lastname             = $request->lastname;
        $chef->email                = $request->email;
        $chef->email_additional     = $request->email_additional;
        $chef->dialcode             = $request->dialcode;
        $chef->phone                = $request->phone;
        $chef->gender               = $request->gender;
        $chef->address              = $request->address;
        $chef->city                 = $request->city;
        $chef->state                = $request->state;
        $chef->zipcode              = $request->zipcode;
        $chef->iso2                 = $request->iso2;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/technician/', $name, 'public');

            if (isset($chef->avatar)) {

                $path   = 'public/uploads/technician/' . $chef->avatar;

                Storage::delete($path);
            }

            $chef->avatar = $name;
        }

        $chef->save();

        return redirect()->route('franchise.chefs.index')->with('success', 'Chef updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Chef::find($id)->delete();
        return redirect()->back()->with('success', 'Chef deleted successfully!');
    }

    public function changeStatus($id)
    {
        $chef = Chef::find($id);
        if ($chef->status == true) {
            Chef::find($id)->update(['status' => false]);
            return redirect()->route('franchise.chefs.index')->with('warning', 'Chef has been disabled successfully!');
        } else {
            Chef::find($id)->update(['status' => true]);
            return redirect()->route('franchise.chefs.index')->with('success', 'Chef has been enabled successfully!');
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        Chef::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Chef password has been reset successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Chef::whereIn('id', $request->chefs)->delete();
        return response()->json(['success' => 'Chefs deleted successfully!'], 200);
    }
      
}
