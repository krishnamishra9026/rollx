<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WarehouseInventory;
use App\Models\WarehouseItem;


class WarehouseInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $item_id = $request->item_id;

        if (isset($item_id)) {
            $items = WarehouseInventory::with('item')->where('warehouse_item_id', $item_id)->latest()->paginate(20);
        }else{
            $items = WarehouseInventory::latest()->with('item')->paginate(20);
        }
        return view('admin.warehouse_inventory.list', compact('items'));
    }

    public function create(Request $request)
    {
        $items = WarehouseItem::all();
        $item_id = $request->item_id;
        return view('admin.warehouse_inventory.create', compact('items', 'item_id'));
    }

    public function store(Request $request)
    {              
        $request->validate([
            'warehouse_item_id' => 'required|exists:warehouse_items,id',
            // 'cost' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'quantity' => 'required|integer|min:1',
            // 'date_inward' => 'required|date',
            // 'date_outward' => 'nullable|date|after_or_equal:date_inward',
        ]);

        $input = $request->all();
        $input['cost'] =  $request->cost ?? 0; 

        WarehouseInventory::create($input);

        return redirect()->route('admin.warehouse-inventory.index', ['item_id' => $request->warehouse_item_id])->with('success', 'Inventory record added successfully.');
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $product = WarehouseInventory::find($request->id);
        $product->quantity = $request->quantity;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully!']);
    }

    public function add(Request $request)
    {              
        $request->validate([
            'warehouse_item_id' => 'required|exists:warehouse_items,id',
            // 'cost' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'quantity' => 'required|integer|min:1',
            // 'date_inward' => 'required|date',
            // 'date_outward' => 'nullable|date|after_or_equal:date_inward',
        ]);    

        $input = $request->all();
        $input['cost'] =  $request->cost ?? 0;      

        $item = WarehouseInventory::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'Inventory record added successfully!',
            'data' => $item
        ]);

    }

    public function edit(WarehouseInventory $warehouseInventory)
    {              
        $items = WarehouseItem::all();
        return view('admin.warehouse_inventory.edit', compact('warehouseInventory', 'items'));
    }

    public function update(Request $request, WarehouseInventory $warehouseInventory)
    {
        $request->validate([
            'cost' => 'required|numeric|min:0',
            'unit' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'date_inward' => 'required|date',
            'date_outward' => 'nullable|date|after_or_equal:date_inward',
        ]);

        $warehouseInventory->update($request->all());

        return redirect()->route('admin.warehouse-inventory.index', ['item_id' => $warehouseInventory->warehouse_item_id])->with('success', 'Inventory updated successfully.');
    }

    public function destroy(WarehouseInventory $warehouseInventory)
    {
        $warehouseInventory->delete();
        return redirect()->route('admin.warehouse-inventory.index')->with('success', 'Inventory record deleted.');
    }
}
