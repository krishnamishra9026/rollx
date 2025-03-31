<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Franchise;
use App\Models\ProductPlateSetting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:franchise');
    }

    public function index()
    {
        return view('franchise.settings.setting', [
            'quantity_per_plate' => Setting::get('quantity_per_plate', 1)
        ]);
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
        //
    }

    public function productPlateSetting(Request $request)
    {
        $filter                     = [];
        $filter['product']             = $request->product;

        $productsQuery = Product::with('plateSetting')
            ->whereHas('franchises', function ($query) {
                    $query->where('franchise_id', auth()->user()->id);
            })->where('selling_type', 'plate');

        if (isset($filter['product'])) {
            $productsQuery->where('id', 'like', $filter['product']);
        }

        $products = $productsQuery->paginate(20)->through(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'full_plate_quantity' => $product->plateSetting->full_plate_quantity ?? 10,
                'half_plate_quantity' => $product->plateSetting->half_plate_quantity ?? 5,
            ];
        });

              // echo '<pre>'; print_r($products->toArray()); echo '</pre>'; exit();
              

        $product_list = Product::latest()->get();

        return view('franchise.settings.plate_setting', compact('products', 'product_list'));
    }


    public function productPlateSettingSave(Request $request)
    {              
        $validated = $request->validate([
            'product_id' => 'required|array',
            'full_plate_quantity' => 'required|array',
            'half_plate_quantity' => 'required|array',
        ]);

        foreach ($validated['product_id'] as $index => $productId) {

            ProductPlateSetting::updateOrCreate(
                [
                    'franchise_id' => auth()->user()->id,
                    'product_id' => $productId,
                ],
                [
                    'full_plate_quantity' => $validated['full_plate_quantity'][$index],
                    'half_plate_quantity' => $validated['half_plate_quantity'][$index],
                ]
            );
        }


        return redirect()->back()->with('success', 'Data has been saved!');
    }


    public function productPriceSetting(Request $request)
    {
        $filter                     = [];
        $filter['product']             = $request->product;

        $productsQuery = Product::whereHas('franchises', function ($query) {
                    $query->where('franchise_id', auth()->user()->id);
            });

        if (isset($filter['product'])) {
            $productsQuery->where('id', 'like', $filter['product']);
        }

        $products = $productsQuery->latest()->paginate(20);  
                                      

        $product_list = Product::latest()->get();

        return view('franchise.settings.price_setting', compact('products', 'product_list'));
    }


    public function productPriceSettingSave(Request $request)
    {                 
          echo '<pre>'; print_r($request->all()); echo '</pre>'; exit();
                                
        $validated = $request->validate([
            'product_id' => 'required|array',
            'price' => 'required|array',
            'sale_price' => 'required|array',
        ]);

        foreach ($validated['product_id'] as $index => $productId) {

            ProductPrice::updateOrCreate(
                [
                    'franchise_id' => auth()->user()->id,
                    'product_id' => $productId,
                ],
                [
                    'price' => $validated['price'][$index],
                    'sale_price' => $validated['sale_price'][$index],
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    

    public function update(Request $request)
    {
        $request->validate([
            'quantity_per_plate' => 'required|integer|min:1',
        ]);

        Setting::set('quantity_per_plate', $request->quantity_per_plate);

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
