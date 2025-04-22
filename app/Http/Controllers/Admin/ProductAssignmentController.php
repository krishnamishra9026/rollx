<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAssignmentController extends Controller
{
    public function assign(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'assignment_type' => 'required|in:kitchen,cart,new_opening,franchise',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string|max:500'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check conditions
        if (!$product->warehouse_inventory) {
            return back()->with('error', 'Product is not available for warehouse inventory');
        }

        if ($request->assignment_type === 'franchise' && !$product->franchise_sale) {
            return back()->with('error', 'Product is not available for franchise sale');
        }

        // Check available quantity
        if ($product->available_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient quantity available');
        }

        // Create assignment record
        ProductAssignment::create([
            'product_id' => $request->product_id,
            'assignment_type' => $request->assignment_type,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'assigned_by' => Auth::guard('administrator')->id(),
            'assigned_at' => now(),
            'status' => 'active'
        ]);

        // Update product quantity
        $product->available_quantity -= $request->quantity;
        $product->sold_quantity += $request->quantity;
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product assigned successfully');
    }

    public function history($productId)
    {
        $product = Product::findOrFail($productId);
        $assignments = ProductAssignment::where('product_id', $productId)
            ->with('assignedByUser')
            ->orderBy('assigned_at', 'desc')
            ->paginate(20);

        return view('admin.products.assignments.history', compact('product', 'assignments'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $existingAssignments = ProductAssignment::where('product_id', $productId)
            ->where('status', 'active')
            ->get();
            
        return view('admin.products.assignments.create', compact('product', 'existingAssignments'));
    }

    public function edit($id)
    {
        $assignment = ProductAssignment::with('product')->findOrFail($id);
        return view('admin.products.assignments.edit', compact('assignment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'assignment_type' => 'required|in:kitchen,cart,new_opening,franchise',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string|max:500'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check conditions
        if (!$product->warehouse_inventory) {
            return back()->with('error', 'Product is not available for warehouse inventory');
        }

        if ($request->assignment_type === 'franchise' && !$product->franchise_sale) {
            return back()->with('error', 'Product is not available for franchise sale');
        }

        if ($product->available_quantity < $request->quantity) {
            return back()->with('error', 'Insufficient quantity available');
        }

        ProductAssignment::create([
            'product_id' => $request->product_id,
            'assignment_type' => $request->assignment_type,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'assigned_by' => Auth::guard('administrator')->id(),
            'assigned_at' => now(),
            'status' => 'active'
        ]);

        $product->available_quantity -= $request->quantity;
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product assigned successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string|max:500'
        ]);

        $assignment = ProductAssignment::findOrFail($id);
        $product = $assignment->product;

        // Calculate quantity difference
        $quantityDiff = $request->quantity - $assignment->quantity;
        
        if ($quantityDiff > 0 && $product->available_quantity < $quantityDiff) {
            return back()->with('error', 'Insufficient quantity available');
        }

        // Update product available quantity
        $product->available_quantity -= $quantityDiff;
        $product->save();

        $assignment->update([
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products.assignments.history', $product->id)
            ->with('success', 'Assignment updated successfully');
    }
}