<?php

namespace App\Http\Controllers\Chef\Auth;

use App\Models\Chef;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:chef');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Chef $chef)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Chef $chef)
    {
        $id             = Auth::guard('chef')->id();
        $chef          = Chef::find($id);
        $chef->avatar  = isset($chef->avatar) ? asset('storage/uploads/chef/'.$chef->avatar) : URL::to('assets/images/users/avatar.png') ;
        return view('chef.settings.my-account', compact('chef'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:chefs,email,' . $id],
            'phone'     => ['required', 'min:8', 'unique:chefs,phone,' . $id],
        ]);

        $chef                  = Chef::find($id);
        $chef->firstname       = $request->firstname;
        $chef->lastname        = $request->lastname;
        $chef->email           = $request->email;
        $chef->iso2            = $request->iso2;
        $chef->dialcode        = $request->dialcode;
        $chef->phone           = $request->phone;

        if($request->hasfile('avatar')){

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/chef/', $name, 'public');

            if(isset($chef->avatar)){

                $path   = 'public/uploads/chef/'.$chef->avatar;

                Storage::delete($path);

            }

            $chef->avatar = $name;

        }

        $chef->save();

        return redirect()->route('chef.my-account.edit', $chef->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chef $chef)
    {
        //
    }
}
