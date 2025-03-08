<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;

class FranchiseSaleReportController extends Controller
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

        $query = Franchise::withCount([
                'orders as total_orders' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT orders.id)');
                },
                'sales as total_sales' => function ($query) {
                    $query->selectRaw('COUNT(DISTINCT sales.id)');
                }
            ])
            ->withSum('orders as total_quantity_ordered', 'quantity')
            ->withSum(['sales as total_quantity_sold' => function ($query) {
                $query->where('status', 'Sold');
            }], 'quantity')
            ->withSum('sales as total_revenue', 'price')
            ->withSum(['sales as total_wastage_quantity' => function ($query) {
                $query->where('status', 'wastage');
            }], 'quantity');

        if (request()->has('franchise')) {
            $query->where('id', request('franchise'));
        }


        // Paginate results
        $sales = $query->latest();

        $sales_data = $sales->get();

         $chartData = [
            'labels' => $sales_data->map(fn($sale) => $sale->firstname . ' ' . $sale->lastname),
            'sales' => $sales_data->pluck('total_sales'), // Total Sales
            'revenue' => $sales_data->pluck('total_revenue'), // Revenue
            'wastage' => $sales_data->pluck('total_wastage_quantity'), // Wastage
        ];     

        $sales = $sales->paginate('20');   

              // echo '<pre>'; print_r($sales->toArray()); echo '</pre>'; exit();
              

        $franchises = Franchise::latest()->get();

        return view('admin.franchises.reports.list', compact('sales', 'franchises', 'chartData'));
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
