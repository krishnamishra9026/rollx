<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Sale;

class OrderSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesData = Sale::select('order_id')
            ->selectRaw('SUM(price) as total_sales')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('GROUP_CONCAT(id) as sales_ids') // Concatenating sales IDs
            ->with(['order.franchise'])
            ->groupBy('order_id')
            ->orderByDesc('order_id')
            ->paginate(20);

        // Prepare data for Chart.js
        $chartData = [
            'labels' => $salesData->pluck('order_id')->toArray(),
            'data' => $salesData->pluck('total_sales')->toArray()
        ];

        return view('admin.orders.sales.report', compact('salesData', 'chartData'));
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
