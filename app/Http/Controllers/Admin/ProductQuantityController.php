<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductQuantityLog;
use App\Models\Product;

class ProductQuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $logs = ProductQuantityLog::where('product_id', $id)->orderBy('date_added', 'desc')->get();
        return response()->json($logs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $validated = $request->validate([
            'product_id' => 'required|array',
            'quantity' => 'required|array',
        ]);

        foreach ($validated['product_id'] as $index => $productId) {


            $product = Product::findOrFail($productId);
            $addedQuantity = $validated['quantity'][$index];

            if ($addedQuantity < 1) {
                continue;
            }

            $oldQuntity = $product->quantity;
            $product->quantity += $addedQuantity;
            $product->available_quantity += $addedQuantity;
            $product->save();


            ProductQuantityLog::updateOrCreate(
                [
                    'product_id' => $productId,
                    'date_added' => now()->toDateTimeString(),
                ],
                [
                    'admin_id' => auth()->user()->id,
                    'added_quantity' => $addedQuantity,
                    'old_quantity' => $oldQuntity,
                    'new_quantity' => $product->quantity,
                ]
            );
       }

       return redirect()->back()->with('success', 'Data has been saved!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $request->validate([
            'added_quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);
        $addedQuantity = $request->input('added_quantity');

        $product->quantity += $addedQuantity;
        $product->available_quantity += $addedQuantity;
        $product->save();

        ProductQuantityLog::create([
            'product_id' => $product->id,
            'added_quantity' => $addedQuantity,
            'old_quantity' => $product->quantity,
            'new_quantity' => $product->quantity + $addedQuantity,
            'date_added' => now()->toDateString(),
        ]);

        return response()->json(['message' => 'Quantity added successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
