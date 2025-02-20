<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;

class SaleReportController extends Controller
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
        $filter['date']       = $request->date;
        $filter['status']           = $request->status;
        $filter['franchise']           = $request->franchise;
        $filter['chef']           = $request->chef;
        $filter['product']           = $request->product;
        $filter['order']           = $request->order;

        $sales              = Sale::with('order', 'product', 'franchise', 'chef');
        $sales              = isset($filter['date']) ? $sales->whereDate('created_at', $filter['date']) : $sales;
        $sales              = isset($filter['status']) ? $sales->where('status', 'LIKE', '%' . $filter['status'] . '%') : $sales;
        $sales              = isset($filter['franchise']) ? $sales->where('franchise_id',  $filter['franchise'] ) : $sales;
        $sales              = isset($filter['chef']) ? $sales->where('chef_id',  $filter['chef'] ) : $sales;
        $sales              = isset($filter['product']) ? $sales->where('product_id',  $filter['product'] ) : $sales;
        $sales              = isset($filter['order']) ? $sales->where('order_id',  $filter['order'] ) : $sales;

        $sales              = $sales->orderBy('created_at', 'desc')->paginate(20);   


        $total_sales = Sale::sum('price');
        $total_quatity = Sale::sum('quantity');

        $total_sold_sales = Sale::where('status', 'Sold')->sum('price');
        $total_sold_quatity = Sale::where('status', 'Sold')->sum('quantity');

        $total_wastage_sales = Sale::where('status', 'Wastage')->sum('price');
        $total_wastage_quatity = Sale::where('status', 'Wastage')->sum('quantity');    

        if( isset($filter['franchise']) && !isset($filter['product']) ){

            $total_sales = Sale::where('franchise_id',  $filter['franchise'] )->sum('price');
            $total_quatity = Sale::where('franchise_id',  $filter['franchise'] )->sum('quantity');

            $total_sold_sales = Sale::where('franchise_id',  $filter['franchise'] )->where('status', 'Sold')->sum('price');
            $total_sold_quatity = Sale::where('franchise_id',  $filter['franchise'] )->where('status', 'Sold')->sum('quantity');

            $total_wastage_sales = Sale::where('franchise_id',  $filter['franchise'] )->where('status', 'Wastage')->sum('price');
            $total_wastage_quatity = Sale::where('franchise_id',  $filter['franchise'] )->where('status', 'Wastage')->sum('quantity');    
        }

        if( isset($filter['product']) && !isset($filter['franchise']) ){

            $total_sales = Sale::where('product_id',  $filter['product'] )->sum('price');
            $total_quatity = Sale::where('product_id',  $filter['product'] )->sum('quantity');

            $total_sold_sales = Sale::where('product_id',  $filter['product'] )->where('status', 'Sold')->sum('price');
            $total_sold_quatity = Sale::where('product_id',  $filter['product'] )->where('status', 'Sold')->sum('quantity');

            $total_wastage_sales = Sale::where('product_id',  $filter['product'] )->where('status', 'Wastage')->sum('price');
            $total_wastage_quatity = Sale::where('product_id',  $filter['product'] )->where('status', 'Wastage')->sum('quantity');    
        }

        if( isset($filter['product']) && isset($filter['franchise']) ){

            $total_sales = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->sum('price');
            $total_quatity = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->sum('quantity');

            $total_sold_sales = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->where('status', 'Sold')->sum('price');
            $total_sold_quatity = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->where('status', 'Sold')->sum('quantity');

            $total_wastage_sales = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->where('status', 'Wastage')->sum('price');
            $total_wastage_quatity = Sale::where('franchise_id',  $filter['franchise'] )->where('product_id',  $filter['product'] )->where('status', 'Wastage')->sum('quantity');    
        }

              

        $orders = Order::all();
        $products = Product::all();
        $franchises = Franchise::all();
        $chefs = Chef::all();

        return view('admin.orders.sales.reports.list', compact('sales', 'filter', 'orders', 'products', 'chefs', 'franchises', 'total_sales', 'total_quatity', 'total_sold_sales', 'total_sold_quatity', 'total_wastage_sales', 'total_wastage_quatity'));
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
