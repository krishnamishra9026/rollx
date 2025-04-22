<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductUnit;

class ProductUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function edit()
    {
        $units = ProductUnit::where('status', 1)->get();
        return view('admin.settings.product-unit', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'abbreviation' => 'required|string|max:10|unique:product_units,abbreviation',
            'description' => 'nullable|string|max:255'
        ]);

        ProductUnit::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'description' => $request->description,
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Product unit added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'abbreviation' => 'required|string|max:10|unique:product_units,abbreviation,'.$id,
            'description' => 'nullable|string|max:255'
        ]);

        $unit = ProductUnit::findOrFail($id);
        $unit->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Product unit updated successfully');
    }

    public function destroy($id)
    {
        $unit = ProductUnit::findOrFail($id);
        $unit->delete();

        return redirect()->back()->with('success', 'Product unit deleted successfully');
    }
}