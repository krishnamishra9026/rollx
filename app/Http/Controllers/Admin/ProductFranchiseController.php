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
        $filter['franchise']             = $request->franchise;

        $products = Product::with('franchises');

        if (isset($filter['product'])) {
            $products = $products->where('id', $filter['product']);
        }

        if (isset($filter['franchise'])) {
            $products = $products->whereHas('franchises', function ($query) use ($filter) {
                $query->where('franchise_id', $filter['franchise']);
            });
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(20);              

        $product_list = Product::latest()->get();
        $franchises = Franchise::latest()->get(['id', 'firstname', 'lastname']);

        $franchiseQuery = Franchise::with('products');

        // Filter by franchise (if a specific franchise is selected)
        if (isset($filter['franchise'])) {
            $franchiseQuery->where('id', request('franchise'));
        }

        // Filter by product (if a specific product is selected)
        if (isset($filter['product'])) {
            $franchiseQuery->whereHas('products', function ($query) {
                $query->where('products.id', request('product'));
            });
        }

        // Get paginated results
        $franchise_list = $franchiseQuery->latest()->paginate(20);           

        return view('admin.product_franchises.list', compact('products', 'product_list', 'franchises', 'franchise_list'));
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
