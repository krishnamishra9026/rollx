<?php

namespace App\Http\Controllers\Franchise\Auth;

use App\Models\Franchise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:franchise');
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
    public function show(Franchise $franchise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Franchise $franchise)
    {
        $id             = Auth::guard('franchise')->id();
        $franchise          = Franchise::find($id);
        $franchise->avatar  = isset($franchise->avatar) ? asset('storage/uploads/franchise/'.$franchise->avatar) : URL::to('assets/images/users/avatar.png') ;
        return view('franchise.settings.my-account', compact('franchise'));
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
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:franchises,email,' . $id],
            'phone'     => ['required', 'min:8', 'unique:franchises,phone,' . $id],
        ]);

        $franchise                  = Franchise::find($id);
        $franchise->firstname       = $request->firstname;
        $franchise->lastname        = $request->lastname;
        $franchise->email           = $request->email;
        $franchise->iso2            = $request->iso2;
        $franchise->dialcode        = $request->dialcode;
        $franchise->phone           = $request->phone;

        if($request->hasfile('avatar')){

            if(isset($franchise->avatar)){

                $path   = 'public/uploads/franchise/'.$franchise->avatar;

                Storage::delete($path);

            }

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/franchise/', $name, 'public');

            $franchise->avatar = $name;

        }

        $franchise->save();

        return redirect()->route('franchise.my-account.edit', $franchise->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Franchise  $franchise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Franchise $franchise)
    {
        //
    }
}
