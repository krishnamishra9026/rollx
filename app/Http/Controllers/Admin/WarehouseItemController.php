<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\WarehouseItem;

use Illuminate\Support\Facades\DB;

class WarehouseItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = WarehouseItem::latest()->paginate(20);
        return view('admin.warehouse_items.list', compact('items'));
    }

    public function create()
    {
        return view('admin.warehouse_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|in:Kg,Packet,Litre,Piece,Box',
        ]);

        WarehouseItem::create($request->all());

        return redirect()->route('admin.warehouse-items.index')->with('success', 'Item added successfully.');
    }

    public function edit(WarehouseItem $warehouseItem)
    {
        return view('admin.warehouse_items.edit', compact('warehouseItem'));
    }

    public function update(Request $request, WarehouseItem $warehouseItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|in:Kg,Packet,Litre,Piece,Box',
        ]);

        $warehouseItem->update($request->all());

        return redirect()->route('admin.warehouse-items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(WarehouseItem $warehouseItem)
    {
        $warehouseItem->delete();
        return redirect()->route('admin.warehouse-items.index')->with('success', 'Item deleted successfully.');
    }
}