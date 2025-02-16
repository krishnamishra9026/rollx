<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Equipment;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class CustomerCompanyController extends Controller
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
        $filter['company']      = $request->company;
        $filter['name']         = $request->name;
        $filter['email']        = $request->email;
        $filter['contact']      = $request->contact;
        $filter['address']      = $request->address;
        $filter['status']       = $request->status;

        $customers              = User::with('mainAddress');
        $customers              = isset($filter['company']) ? $customers->where('company', 'LIKE', '%' . $filter['company'] . '%')->orWhere('company', 'LIKE', '%' . $filter['company'] . '%') : $customers;
        $customers              = isset($filter['name']) ? $customers->where('name', 'LIKE', '%' . $filter['name'] . '%')->orWhere('name', 'LIKE', '%' . $filter['name'] . '%') : $customers;
        $customers              = isset($filter['email']) ? $customers->where('email', 'LIKE', '%' . $filter['email'] . '%') : $customers;
        $customers              = isset($filter['contact']) ? $customers->where('contact', 'LIKE', '%' . $filter['contact'] . '%') : $customers;
        $customers              = isset($filter['status']) ? $customers->where('status', $filter['status']) : $customers;

        if (isset($filter['address'])) {
            $filter_address = $filter['address'];
            $customers->whereHas('mainAddress', function ($q) use ($filter_address) {
                $q->where(function ($q) use ($filter_address) {
                    $q->where(DB::raw("concat(address,' ',zipcode)"), 'LIKE', '%' . $filter_address . '%');
                });
            });
        }

        $customers              = $customers->orderBy('id', 'desc')->paginate(20);

        return view('admin.customers.list', compact('customers', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('admin.customers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'company'                 => ['required', 'string', 'max:255'],
            'name'                    => ['required', 'string', 'max:255'],
            'email'                   => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact'                 => ['required'],
            'status'                  => ['required'],
        ];

        $messages = [
            'company.required'              => 'Please enter customer / company name.',
            'name.required'                 => 'Please enter contact person name.',
            'email.required'                => 'Please enter customer / company email address.',
            'contact.required'              => 'Please enter customer / company contact number.',
            'status.required'               => 'Please select status',
        ];

        $this->validate($request, $rules, $messages);

        $customer                       = new User();
        $customer->company              = $request->company;
        $customer->name                 = $request->name;
        $customer->email                = $request->email;
        $customer->alternate_email      = $request->alternate_email;
        $customer->iso2                 = $request->iso2;
        $customer->dialcode             = $request->dialcode;
        $customer->contact              = $request->contact;
        $customer->alternate_iso2       = $request->alternate_iso2;
        $customer->alternate_dialcode   = $request->alternate_dialcode;
        $customer->alternate_contact    = $request->alternate_contact;
        $customer->password             = Hash::make('password');
        $customer->status               = $request->status;
        $customer->remark               = $request->remark;
        $customer->email_verified_at    = now();
        $customer->administrator_id     = Auth::user()->id;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/customer/', $name, 'public');

            $customer->avatar = $name;
        }

        $customer->save();


        foreach ($request->addmore as $val) {
            if (!empty($val['address']) && !empty($val['zipcode'])  && !empty($val['unit_number'])) {

                $address                      = new UserAddress();
                $address->user_id             = $customer->id;
                $address->name                = $request->name;
                $address->address             = $val['address'];
                $address->latitude            = $val['latitude'];
                $address->longitude           = $val['longitude'];
                $address->zipcode             = $val['zipcode'];
                $address->phone               = $request->contact;
                $address->unit_number         = isset($val['unit_number']) ? $val['unit_number'] : null;
                $address->is_primary_address  = $val['is_primary_address'];
                $address->save();

                if ($request->is_primary_address == true) {
                    UserAddress::where('user_id', $customer->id)->whereNot('id', $address->id)->update(['is_primary_address' => false]);
                }
            }
        }

        return redirect()->route('admin.customers.index')->with('success', 'General Info added successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $customer          = User::find($id);
        $customer->avatar  = isset($customer->avatar) ? asset('storage/uploads/customer/' . $customer->avatar) : URL::to('assets/images/users/avatar.png');
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $customer          = User::find($id);
        $customer->avatar  = isset($customer->avatar) ? asset('storage/uploads/customer/' . $customer->avatar) : URL::to('assets/images/users/avatar.png');
        $addresses         = UserAddress::where('user_id', $id)->get();
        $count             = UserAddress::where('user_id', $id)->count();

        return view('admin.customers.edit', compact('customer', 'addresses', 'count'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $rules = [
            'company'                 => ['required', 'string', 'max:255'],
            'name'                    => ['required', 'string', 'max:255'],
            'email'                   => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'contact'                 => ['required'],
            'status'                  => ['required'],
        ];

        $messages = [
            'company.required'              => 'Please enter customer / company name.',
            'name.required'                 => 'Please enter contact person name.',
            'email.required'                => 'Please enter customer / company email address.',
            'contact.required'              => 'Please enter customer / company contact number.',
            'status.required'               => 'Please select status',
        ];

        $customer                       = User::find($id);
        $customer->company              = $request->company;
        $customer->name                 = $request->name;
        $customer->alternate_email      = $request->alternate_email;
        $customer->email                = $request->email;
        $customer->iso2                 = $request->iso2;
        $customer->dialcode             = $request->dialcode;
        $customer->contact              = $request->contact;
        $customer->alternate_iso2       = $request->alternate_iso2;
        $customer->alternate_dialcode   = $request->alternate_dialcode;
        $customer->alternate_contact    = $request->alternate_contact;
        $customer->password             = Hash::make('password');
        $customer->remark               = $request->remark;
        $customer->status               = $request->status;
        $customer->email_verified_at    = now();

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/customer/', $name, 'public');

            $customer->avatar = $name;
        }

        $customer->save();

        UserAddress::where('user_id', $customer->id)->delete();

        if (isset($request->addmore)) {
            foreach ($request->addmore as $val) {
                if (!empty($val['address']) && !empty($val['zipcode'])  && !empty($val['unit_number'])) {

                    $address                      = new UserAddress();
                    $address->user_id             = $customer->id;
                    $address->name                = $request->name;
                    $address->address             = $val['address'];
                    $address->latitude            = $val['latitude'];
                    $address->longitude           = $val['longitude'];
                    $address->zipcode             = $val['zipcode'];
                    $address->phone               = $request->contact;
                    $address->unit_number         = isset($val['unit_number']) ? $val['unit_number'] : null;
                    $address->is_primary_address  = $val['is_primary_address'];
                    $address->save();

                    if ($request->is_primary_address == true) {
                        UserAddress::where('user_id', $customer->id)->whereNot('id', $address->id)->update(['is_primary_address' => false]);
                    }
                }
            }
        }

        return redirect()->route('admin.customers.index')->with('success', 'General Info updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_exists       = Order::where("user_id", $id)->exists();
        $equipment_exists   = Equipment::where("user_id", $id)->exists();
        $job_exists         = Job::where("user_id", $id)->exists();
        if ($order_exists) {
            return redirect()->route('admin.customers.index')->with('error', 'Customer cannot be deleted because it has an order.');
        }
        if ($equipment_exists) {
            return redirect()->route('admin.customers.index')->with('error', 'Customer cannot be deleted because it has an equipment.');
        }
        if($job_exists) {
            return redirect()->route('admin.customers.index')->with('error', 'Customer cannot be deleted because it has an job.');
        }
        User::find($id)->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully !');
    }

    public function getAddresses(Request $request)
    {
        $addresses      = UserAddress::where('user_id', $request->customer_id)->get();
        $primary_address_id      = UserAddress::where('user_id', $request->customer_id)->where('is_primary_address', true)->value('id');
        $output         = '';
        $output        .= '<option value="">Choose Address</option>';
        foreach ($addresses as $address) {
            $output .= '<option value="' . $address->id . '">' . $address->address . ' ' . $address->city . ' ' . $address->state . ' ' . $address->country . ' ' . $address->zipcode . '</option>';
        }

        return response()->json(['addresses' => $output, 'primary_address_id' => $primary_address_id], 200);
    }

    public function getEquipments(Request $request)
    {
        $equipments      = Equipment::where('user_id', $request->customer_id)->get();

        $output         = '';
        $output        .= '<option value="">Choose Equipment</option>';
        foreach ($equipments as $equipment) {
            $output    .= '<option value="' . $equipment->id . '">' . $equipment->equipment_name . '</option>';
        }

        return response()->json(['equipments' => $output], 200);
    }
}
