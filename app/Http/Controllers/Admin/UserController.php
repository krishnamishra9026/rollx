<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Country;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        $filter['status']       = $request->status;

        $superadmins            = Administrator::query();
        $superadmins            = isset($filter['name']) ? $superadmins->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $filter['name'] . '%') : $superadmins;
        $superadmins            = isset($filter['email']) ? $superadmins->where('email', 'LIKE', '%' . $filter['email'] . '%') : $superadmins;
        $superadmins            = isset($filter['phone']) ? $superadmins->where('phone', 'LIKE', '%' . $filter['phone'] . '%') : $superadmins;

        if(isset($filter['status'])){
            if($filter['status'] == 'Yes'){
                $superadmins      = $superadmins->where('status', true);
            }

            if($filter['status'] == 'No'){
                $superadmins      = $superadmins->where('status', false);
            }
        }

        $superadmins          = $superadmins->orderBy('id', 'desc')->paginate(20);

        return view('admin.users.list', compact('superadmins', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:administrators'],
            'phone'     => ['required', 'min:8', 'unique:administrators'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
           /* 'gender'    => ['required'],
            'status'    => ['required'],*/
            'role'      => ['required'],
        ]);

        $superadmin                         = new Administrator();
        $superadmin->firstname              = $request->firstname;
        $superadmin->lastname               = $request->lastname;
        $superadmin->email                  = $request->email;
        $superadmin->password               = Hash::make($request->password);
        $superadmin->dialcode               = $request->dialcode;
        $superadmin->phone                  = $request->phone;
        $superadmin->iso2                   = $request->iso2;
        $superadmin->status                 = $request->status;
        $superadmin->gender                 = $request->gender;
        $superadmin->address                = $request->address;
        $superadmin->city                   = $request->city;
        $superadmin->state                  = $request->state;
        $superadmin->zipcode                = $request->zipcode;
        $superadmin->email_verified_at      = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/admins/'.$superadmin->slug, $name, 'public');

            $superadmin->avatar = $name;
        }

        $superadmin->save();

        $superadmin->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $superadmin          = Administrator::find($id);
        $superadmin->avatar  = isset($superadmin->avatar) ? asset('storage/uploads/admins/'.$superadmin->slug.'/'.$superadmin->avatar) : "https://placehold.co/150x150/0657BB/FFF?text=".$superadmin->firstname[0].''.$superadmin->lastname[0];
        $superadmin->country = Country::where('code', $superadmin->iso2)->first()->name;
        return view('admin.users.show', compact('superadmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $superadmin          = Administrator::find($id);
        $roles = Role::all();
        $superadmin->avatar  = isset($superadmin->avatar) ? asset('storage/uploads/admins/'.$superadmin->slug.'/'.$superadmin->avatar) : "https://placehold.co/150x150/0657BB/FFF?text=".$superadmin->firstname[0].''.$superadmin->lastname[0];
        return view('admin.users.edit', compact('superadmin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'phone'     => ['required', 'min:8', 'unique:admins,phone,' . $id],
            'gender'    => ['required'],
            'status'    => ['required'],
            'role'      => ['required']
        ]);

        $superadmin                  = Administrator::find($id);
        $superadmin->firstname       = $request->firstname;
        $superadmin->lastname        = $request->lastname;
        $superadmin->email           = $request->email;
        $superadmin->dialcode        = $request->dialcode;
        $superadmin->phone           = $request->phone;
        $superadmin->iso2            = $request->iso2;
        $superadmin->status          = $request->status;
        $superadmin->gender          = $request->gender;
        $superadmin->address         = $request->address;
        $superadmin->city            = $request->city;
        $superadmin->state           = $request->state;
        $superadmin->zipcode         = $request->zipcode;


        if($request->hasfile('avatar')){

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/admins/'.$superadmin->slug, $name, 'public');

            if(isset($superadmin->avatar)){

                $path   = 'public/uploads/admins/'.$superadmin->slug.'/'.$superadmin->avatar;

                Storage::delete($path);

            }

            $superadmin->avatar = $name;

        }

        $superadmin->save();

        $superadmin->syncRoles($request->role);

        return redirect()->route('admin.users.index')->with('success', 'Superadmin updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Administrator::find($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Admin deleted successfully!');
    }

    public function changeStatus($id){
        $admin = Administrator::find($id);
        if($admin->status == true){
            Administrator::find($id)->update(['status' => false]);
            return redirect()->route('admin.users.index')->with('warning', 'Admin has been disabled successfully!');
        }else{
            Administrator::find($id)->update(['status' => true]);
            return redirect()->route('admin.users.index')->with('success', 'Admin has been enabled successfully!');
        }
    }

    public function resetPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'min:8', 'confirmed']
        ]);
        Administrator::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.users.index')->with('success', 'Admin password has been reset successfully!');
    }

    public function bulkDelete(Request $request)
    {
        Administrator::whereIn('id', $request->users)->delete();
        return response()->json(['success' => 'Admins deleted successfully!'], 200);
    }

}
