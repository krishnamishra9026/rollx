<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\InventoryEquipment;
use App\Models\InventoryEquipmentPart;
use App\Models\InventoryEquipmentSerialNo;
use App\Models\Order;
use App\Models\Part;
use App\Models\PartSerialNo;
use App\Models\Supplier;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryEquipmentController extends Controller
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

        $equipments              = InventoryEquipment::query();
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
        return view('admin.inventory-equipments.list', compact('equipments', 'customers', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory-equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "equipment_name" => ["required"],
            "date_added"     => ["required"]
        ]);

        $equipment = InventoryEquipment::create([
            'equipment_name'    => $request->equipment_name,
            'date_added'        => $request->date_added,
            'remark'            => $request->remark,
        ]);

        if(!empty($request->items) && is_array($request->items)){
            foreach ($request->items as $key => $item) {
                InventoryEquipmentSerialNo::create([
                    'inventory_equipment_id'    => $equipment->id,
                    'serial_no'                 => $item["serial_no"]
                ]);
            }
        }

        return redirect()->route('admin.inventory-equipment.createPart', $equipment->id)->with('success', 'Equipment created sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment       = InventoryEquipment::find($id);
        $supplier        = Supplier::find(1);
        return view('admin.inventory-equipments.show', compact('equipment', 'supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipment       = InventoryEquipment::find($id);
        return view('admin.inventory-equipments.edit.equipment-info', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "equipment_name" => ["required"],
            "date_added"     => ["required"]
        ]);

        $equipment = InventoryEquipment::find($id)->update([
            'equipment_name'    => $request->equipment_name,
            'date_added'        => $request->date_added,
            'remark'            => $request->remark,
        ]);

        InventoryEquipmentSerialNo::where("inventory_equipment_id", $id)->where("deducted", false)->delete();

        if(!empty($request->items) && is_array($request->items)){
            foreach ($request->items as $key => $item) {
                InventoryEquipmentSerialNo::create([
                    'inventory_equipment_id'    => $id,
                    'serial_no'                 => $item["serial_no"]
                ]);
            }
        }

        return redirect()->back()->with('success', 'Equipment updated sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order_exists = Order::where('existing_equipment', $id)->exists();
        if($order_exists) {
            return redirect()->back()->with('error', 'Equipment cannot be deleted as there is an ongoing order for this equipment.');
        }
        InventoryEquipment::find($id)->delete();
        return redirect()->back()->with('success', 'Equipment deleted sucessfully!');
    }

    public function createPart(Request $request,$id)
    {
        $equipment          = InventoryEquipment::find($id);
        $categories         = Category::whereType('main-category')->get();
        return view('admin.inventory-equipments.edit.add-parts',compact('id','categories','equipment'));
    }

    public function addPart(Request $request)
    {
        try {
            $quantity = Part::find($request->part_id)->quantity;

            $order_part = InventoryEquipmentPart::create([
                'inventory_equipment_id'    => $request->equipment_id,
                'part_id'                   => $request->part_id,
                'quantity'                  => $request->quantity,
            ]);

            $equipment              = InventoryEquipment::find($request->equipment_id);

            $html = view('admin.inventory-equipments.parts-row', compact('equipment'))->render();

            return response()->json(['html' => $html], 200);
    }
    catch(\Exception $e) {
          dd($e);
        return false;
    }
    }

    public function getSerials(Request $request){
        $serials = InventoryEquipmentSerialNo::where("inventory_equipment_id", $request->id)->get();

        $html = "<option>Choose Serial No.</option>";
        foreach ($serials as $key => $serial) {
            $html .= "<option value='$serial->serial_no'>$serial->serial_no</option>";
        }

        return response()->json(['html' => $html], 200);
    }

    public function deleteEquipmentPart($id){
        InventoryEquipmentPart::find($id)->delete();
        return redirect()->back()->with('success', 'Part deleted successfully');
    }
}
