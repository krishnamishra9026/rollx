<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{
    public function Contact() {
        return view('guest.contact');
    }

    public function saveContact(Request $request)
    {

        $this->validate($request, [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:leads'],
            'phone'             => ['required', 'min:8', 'unique:leads'],
            'password'          => ['required', 'string', 'min:8']
        ]);


        $nameParts = explode(' ', trim($request->firstname), 2);
        $firstname = $nameParts[0];
        $lastname = $nameParts[1] ?? '';

        $supplier                       = new Lead();
        $supplier->company            = $request->company;
        $supplier->firstname            = $firstname;
        $supplier->lastname             = $lastname;
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
        $supplier->status               = 'Fresh';
        $supplier->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/supplier/', $name, 'public');

            $supplier->avatar = $name;
        }

        $supplier->save();
        
        return redirect()->back()->with('success', 'Enquiry submitted successfully!');
    }

}
