<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\ProductPrice;
use DB;

class ProductPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $filter                     = [];
        $filter['product']             = $request->product;
        $filter['franchise']     = $request->franchise;

        $product_prices              = ProductPrice::query();
        $product_prices              = isset($filter['product']) ? $product_prices->where('product_id', $filter['product'] ) : $product_prices;
        $product_prices              = isset($filter['franchise']) ? $product_prices->where('franchise_id', $filter['franchise'] ) : $product_prices;

        $product_prices              = $product_prices->orderBy('id', 'desc')->paginate(20);

        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();

        return view('admin.product_prices.list', compact('product_prices', 'filter', 'products', 'franchises'));
    }

    public function create()
    {
        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();

        return view('admin.product_prices.create', compact('products', 'franchises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'franchise_id' => 'required|exists:franchises,id',
            'price' => 'required|numeric|min:0',
        ]);

        $product_rice_exist = ProductPrice::where('product_id', $request->product_id)
        ->where('franchise_id', $request->franchise_id)
        ->exists();

        if ($product_rice_exist) {
            return redirect()->back()->with('error', 'Product Price Already exists, please edit!')->withInput($request->all());
        }

        ProductPrice::create($validated);

        return redirect()->route('admin.product-prices.index')->with('success', 'Product Price added successfully!');
    }

    public function updatePrice(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_prices,id',
            'price' => 'required|min:0'
        ]);

        $product = ProductPrice::find($request->id);
        $product->price = $request->price;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Price updated successfully!']);
    }

    public function edit(string $id)
    {
        $product_prices       = ProductPrice::find($id);
        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();
        return view('admin.product_prices.edit', compact('product_prices', 'products', 'franchises'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price' => 'required|min:0',
        ]);

        $productPrice = ProductPrice::findOrFail($id);
        $productPrice->update($validated);

        return redirect()->route('admin.product-prices.index')->with('success', 'Product Price updated successfully!');
    }

    public function destroy(string $id)
    {
        ProductPrice::find($id)->delete();
        return redirect()->route('admin.product-prices.index')->with('success', 'Product deleted successfully');
    }


    public function show(Product $product)
    {
        $prices = $product->productPrices; // Get all prices for the product
        return view('product_prices.index', compact('product', 'prices'));
    }
}


