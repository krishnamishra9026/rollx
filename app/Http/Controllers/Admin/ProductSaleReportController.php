<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $filter = [];
        $filter['product'] = $request->product;

        $query = Product::withCount([
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
            ->withSum('sales as total_quantity', 'quantity')
            ->withSum(['sales as total_wastage_quantity' => function ($query) {
                $query->where('status', 'wastage');
            }], 'quantity')
            // Total amount ordered (Ordered Quantity * Price in Orders Table)
            ->withSum(['orders as total_amount_ordered' => function ($query) {
                $query->selectRaw('SUM(total_price)');
            }], 'quantity')
            // Total amount sold (Sold Quantity * Price in Sales Table)
            ->withSum(['sales as total_amount_sold' => function ($query) {
                $query->selectRaw('SUM(price)');
            }], 'quantity');

        if (request()->has('product')) {
            $query->where('id', request('product'));
        }

        // Fetch total sums across all products
        $productId = request('product'); 

        $totals = Product::selectRaw("
                SUM((SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.id)) as total_quantity_ordered,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id AND sales.status = 'Sold')) as total_quantity_sold,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id AND sales.status = 'Wastage')) as total_quantity_wastage,
                SUM((SELECT SUM(quantity) FROM sales WHERE sales.product_id = products.id )) as total_quantity,
                SUM((SELECT SUM(total_price) FROM orders WHERE orders.product_id = products.id)) as total_amount_ordered,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id AND sales.status = 'Sold')) as total_amount_sold,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id AND sales.status = 'Wastage')) as total_amount_wastage,
                SUM((SELECT SUM(price) FROM sales WHERE sales.product_id = products.id )) as total_amount
            ")
            ->when($productId, function ($query) use ($productId) {
                $query->where('id', $productId);
            })
            ->first();

        $sales = $query->latest();
        $product_list = $sales->get();
        $sales = $query->latest()->paginate(20);             

        $products = Product::latest()->get();

        return view('admin.products.reports.list', compact('sales', 'filter', 'product_list', 'products', 'totals'));

    }

    public function indexOld(Request $request)
    {
        $filter                     = [];
        $filter['product']           = $request->product;

       
       $query = Product::withCount([
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

        if (request()->has('product')) {
            $query->where('id', request('product'));
        }


        // Paginate results
        $sales = $query->latest();
        $product_list = $sales->get();
        $sales = $query->latest()->paginate(20);

              echo '<pre>'; print_r($sales->toArray()); echo '</pre>'; exit();
              


        $products = Product::latest()->get();

        return view('admin.products.reports.list', compact('sales', 'filter', 'product_list', 'products'));
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
