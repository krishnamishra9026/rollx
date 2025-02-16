<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EquipmentExport;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\Supplier;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\OrderPart;
use App\Models\Order;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
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
        $filter                     = [];
        $filter['date']             = $request->date;
        $filter['customer']         = $request->customer;
        $filter['address']          = $request->address;
        $filter['name']             = $request->name;
        $filter['serial_number']    = $request->serial_number;

        $equipments              = Equipment::query();
        $equipments              = isset($filter['date']) ? $equipments->where('installation_date', $filter['date']) : $equipments;
        $equipments              = isset($filter['customer']) ? $equipments->where('user_id', $filter['customer']) : $equipments;
        $equipments              = isset($filter['name']) ? $equipments->where('equipment_name', 'LIKE', '%' . $filter['name'] . '%') : $equipments;
        $equipments              = isset($filter['serial_number']) ? $equipments->where('serial_number', 'LIKE', '%' . $filter['serial_number'] . '%') : $equipments;

        if (isset($filter['address'])) {
            $filter_address = $filter['address'];
            $equipments->whereHas('address', function ($q) use ($filter_address) {
                $q->where(function ($q) use ($filter_address) {
                    $q->where(DB::raw("concat(address,' ',zipcode)"), 'LIKE', '%' . $filter_address . '%');
                    //$q->where(DB::raw("concat(address, ' ', city, ' ', state, ' ', country, ' ', zipcode)"), 'LIKE', '%' . $filter_address . '%');
                });
            });
        }

        $equipments              = $equipments->orderBy('id', 'desc')->paginate(20);
        $customers               = User::get();
        return view('admin.equipments.list', compact('equipments', 'customers', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $equipment       = Equipment::find($id);
        $supplier        = Supplier::find(1);
        return view('admin.equipments.show', compact('equipment', 'supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $equipment       = Equipment::find($id);
        $customers       = User::get();
        $addresses       = UserAddress::where('user_id', $equipment->user_id)->get();
        return view('admin.equipments.edit', compact('equipment', 'customers', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [

            'equipment_assemble_type'  => ['required', 'string', 'max:255'],
            'equipment_name'           => ['required', 'string', 'max:255'],
            'customer'                 => ['required'],
            'address'                  => ['required'],
            'installation_date'        => ['required', 'date'],
            'warranty_upto'            => ['required'],
            'service_contract'         => ['required'],
        ];

        $messages = [
            'equipment_assemble_type.required'  => 'Please choose equipment assemble type.',
            'equipment_name.required'           => 'Please enter equipment name.',
            'customer.required'                 => 'Please choose customer / company.',
            'address.required'                  => 'Please choose customer / company address.',
            'installation_date.required'        => 'Please choose installation date of equipment.',
            'warranty_upto.required'            => 'Please choose the date upto which warranty is valid.',
            'service_contract.required'         => 'Please choose whether service contract is required.',
            'service_start_date.required'       => 'Please choose service start date.',
            'service_interval.required'         => 'Please choose service interval.',
        ];

        $this->validate($request, $rules, $messages);

        $order = Equipment::where('id', $id)->update([

            'equipment_assemble_type'   => $request->equipment_assemble_type,
            'user_id'                   => $request->customer,
            'user_address_id'           => $request->address,
            'equipment_name'            => $request->equipment_name,
            'installation_date'         => $request->installation_date,
            'warranty_upto'             => $request->warranty_upto,
            'warranty_date'             => $request->warranty_date,
            'service_contract'          => $request->service_contract,
            'service_start_date'        => $request->service_start_date,
            'service_interval'          => $request->service_interval,
        ]);

        return redirect()->route('admin.equipments.index')->with('success', 'Equipment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipment::find($id)->delete();
        return redirect()->route('admin.equipments.index')->with('success', 'Equipment deleted successfully');
    }

    public function getEquipmentsByAddress(Request $request){

        $equipments      = Equipment::where('user_address_id', $request->address_id)->get();

        $output         = '';

        if(count($equipments) > 0){
            $output        .= '<option value="">Choose Equipment</option>';
            foreach ($equipments as $equipment) {
                 $serial_number  = Order::where('user_address_id', $request->address_id)->value('serial_number');
                 $output .= '<option value="' . $equipment->id . '" data-serial-no="' . $equipment->serial_number . '">' . $equipment->equipment_name . ' (' . $serial_number . ')</option>';

            }
        }else{
            $output        .= '<option value="">No Equipment installed on above selected address</option>';
        }


        return response()->json(['equipments' => $output], 200);
    }

    public function getPartDetails(Request $request){

        $part = EquipmentPart::with('part', 'part.category')->find($request->part_id);
        // $collect_parts = EquipmentPart::with('part')->where('equipment_id',$part->equipment_id)->get()->toArray();
        //  $equipment = Part::with('part')->where('order_id',$request->job_id)->get();
        // $collect_parts = $equipment->pluck('part');
        // $collect_parts = OrderPart::with('part');
         $equipment = EquipmentPart::with('part', 'part.category')->get();
         $collect_parts = $equipment->pluck('part');

        $part->part_name = $part->part->part;
        $part->category = $part->part->category->category;
        return response()->json(['part' => $part,'collect_parts'=>$collect_parts], 200);
    }

    public function exports()
    {
        return Excel::download(new EquipmentExport(), 'Equipments.xlsx');
    }
}
