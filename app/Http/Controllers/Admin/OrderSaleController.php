<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Sale;

use App\Models\Product;
use App\Models\Franchise;
use App\Models\Chef;

class OrderSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter                     = [];
        $filter['date']       = $request->date;
        $filter['status']           = $request->status;
        $filter['franchise']           = $request->franchise;
        $filter['product']           = $request->product;
        $filter['order']           = $request->order;

        
        $salesData = Sale::select('order_id')
            ->selectRaw('SUM(price) as total_sales')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('GROUP_CONCAT(id) as sales_ids') // Concatenating sales IDs
            ->with(['order.franchise'])
            ->when($filter['date'], function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->when($filter['status'], function ($query, $status) {
                return $query->whereHas('order', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            })
            ->when($filter['franchise'], function ($query, $franchise) {
                return $query->whereHas('order.franchise', function ($q) use ($franchise) {
                    $q->where('id', $franchise);
                });
            })

            ->when($filter['product'], function ($query, $product) {
                return $query->whereHas('product', function ($q) use ($product) {
                    $q->where('product_id', $product);
                });
            })
            ->when($filter['order'], function ($query, $order) {
                return $query->where('order_id', $order);
            })
            ->groupBy('order_id')
            ->orderByDesc('order_id')
            ->paginate(20);


        $totalStats = Sale::selectRaw('SUM(price) as total_sales, SUM(quantity) as total_quantity')
            ->when($filter['date'], function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->when($filter['status'], function ($query, $status) {
                return $query->whereHas('order', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            })
            ->when($filter['franchise'], function ($query, $franchise) {
                return $query->whereHas('order.franchise', function ($q) use ($franchise) {
                    $q->where('id', $franchise);
                });
            })
            ->when($filter['product'], function ($query, $product) {
                return $query->whereHas('product', function ($q) use ($product) {
                    $q->where('product_id', $product);
                });
            })
            ->when($filter['order'], function ($query, $order) {
                return $query->where('order_id', $order);
            })
            ->first();

        // Prepare data for Chart.js
        $chartData = [
            'labels' => $salesData->pluck('order_id')->toArray(),
            'data' => $salesData->pluck('total_sales')->toArray()
        ];

        $orders = Order::latest()->get();
        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();
        $chefs = Chef::latest()->get();

        return view('admin.orders.sales.report', compact('salesData', 'chartData', 'filter', 'orders', 'products', 'chefs', 'franchises'));
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
