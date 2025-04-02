<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;

class ProductSaleReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        $this->middleware('auth:franchise');
    }

    public function index(Request $request)
    {
        $filter = [];
        $filter['product'] = $request->product;

        $franchiseId = auth()->user()->id; // Get franchise_id from request

        $query = Product::whereHas('franchises', function ($query) {
                $query->where('franchise_id', auth()->user()->id);
            })->withCount([
                'orders as total_orders' => function ($query) use ($franchiseId) {
                    $query->where('franchise_id', $franchiseId)
                        ->selectRaw('COUNT(DISTINCT orders.id)');
                },
                'sales as total_sales' => function ($query) use ($franchiseId) {
                    $query->where('franchise_id', $franchiseId)
                        ->selectRaw('COUNT(DISTINCT sales.id)');
                }
            ])
            ->withSum(['orders as total_quantity_ordered' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId);
            }], 'quantity')
            ->withSum(['sales as total_quantity_sold' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId)->where('status', 'Sold');
            }], 'quantity')
            ->withSum(['sales as total_revenue' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId);
            }], 'price')
            ->withSum(['sales as total_quantity' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId);
            }], 'quantity')
            ->withSum(['sales as total_wastage_quantity' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId)->where('status', 'wastage');
            }], 'quantity')
            ->withSum(['orders as total_amount_ordered' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId)
                    ->selectRaw('SUM(total_price)');
            }], 'quantity')
            ->withSum(['sales as total_amount_sold' => function ($query) use ($franchiseId) {
                $query->where('franchise_id', $franchiseId)
                    ->selectRaw('SUM(price)');
            }], 'quantity');

        if (request()->has('product')) {
            $query->where('id', request('product'));
        }

        // Fetch total sums across all products for the given franchise
        $totals = Product::whereHas('franchises', function ($query) {
                    $query->where('franchise_id', auth()->user()->id);
                })->selectRaw("
                SUM((SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.id AND orders.franchise_id = ?)) as total_quantity_ordered,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ? AND sales.status = 'Sold')) as total_quantity_sold,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ? AND sales.status = 'Wastage')) as total_quantity_wastage,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ?)) as total_quantity,
                SUM((SELECT SUM(total_price) FROM orders WHERE orders.product_id = products.id AND orders.franchise_id = ?)) as total_amount_ordered,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ? AND sales.status = 'Sold')) as total_amount_sold,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ? AND sales.status = 'Wastage')) as total_amount_wastage,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id AND sales.franchise_id = ?)) as total_amount
            ", array_fill(0, 8, $franchiseId)) // Fill query bindings with franchise_id
            ->when(request('product'), function ($query) {
                $query->where('id', request('product'));
            })
            ->first();
        $sales = $query->latest();
        $product_list = $sales->get();
        $sales = $query->latest()->paginate(20);             

        $products = Product::latest()->get();

        

        return view('franchise.products.reports.list', compact('sales', 'filter', 'product_list', 'products', 'totals'));

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
