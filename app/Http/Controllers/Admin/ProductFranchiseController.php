<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Notifications\WalletBalanceAdded;


use App\Models\Franchise;
use App\Models\ProductFranchise;
use App\Models\Product;

class ProductFranchiseController extends Controller
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
        $filter                     = [];
        $filter['product']             = $request->product;

        $products  = Product::with('franchises');
        $products  = isset($filter['product']) ? $products->where('id', $filter['product']) : $products;
        $products  = $products->orderBy('created_at', 'desc')->paginate(20);     

              // echo '<pre>'; print_r($products->toArray()); echo '</pre>'; exit();
              

        $product_list = Product::latest()->get();
        $franchises = Franchise::latest()->get(['id', 'firstname', 'lastname']);

        return view('admin.product_franchises.list', compact('products', 'product_list', 'franchises'));
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
            'franchise_id' => 'required|array',
        ]);

        $franchiseIds = $validated['franchise_id'];

        foreach ($request->franchise_id as $key => $franchise) {

            foreach ($franchise as $key1 => $id) {
                ProductFranchise::updateOrCreate(
                    [
                        'product_id' => $key,
                        'franchise_id' => $id
                    ],
                    [
                        'price' => 0
                    ]
                );
            }
        }

        return redirect()->route('admin.product-franchises.index')->with('success', 'Product assigned to franchises successfully!');
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
    public function edit(string $id)
    {
        //
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
