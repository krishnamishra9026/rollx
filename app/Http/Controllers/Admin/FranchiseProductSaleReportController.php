<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;

class FranchiseProductSaleReportController extends Controller
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
        $filter['franchise'] = $request->franchise;

        $productId = $request->product;
        $franchise = $request->franchise;

        $sales = Franchise::with(['products' => function($query) use ($productId) {
        $query->select('products.id', 'products.name') // Selecting specific columns
            ->when($productId, function ($q) use ($productId) {
                $q->where('products.id', $productId); // Apply filter for specific product ID
            })
            ->withSum(['orders as ordered_quantity' => function ($query) {
                $query->selectRaw('sum(quantity)');
            }], 'quantity')
            ->withSum(['sales as sold_quantity' => function ($query) {
                $query->where('status', 'sold'); // Assuming 'type' column differentiates sold and wastage
            }], 'quantity')
            ->withSum(['sales as wastage_quantity' => function ($query) {
                $query->where('status', 'wastage'); // Assuming 'type' column differentiates sold and wastage
            }], 'quantity');
        }])
        ->when($franchise, function ($q) use ($franchise) {
            $q->where('franchises.id', $franchise); // Apply filter for specific franchise group ID
        })
        ->paginate(20);

        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();

        return view('admin.franchises.products.reports.list', compact('filter', 'sales', 'products', 'franchises'));

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


    public function getData($value='')
    {
         $franchiseFilter = $request->input('franchise'); // franchise filter, e.g., franchise name or ID
    $productFilter = $request->input('product'); // product filter, e.g., product name or ID

    $report = Franchise::with(['products' => function($query) use ($productFilter) {
        // Select necessary fields
        $query->select('id', 'name', 'franchise_id')
              ->withSum('orders as ordered_quantity', 'ordered_quantity')
              ->withSum('sales as sold_quantity', function ($query) {
                  $query->where('status', 'sold');
              })
              ->withSum('sales as wastage_quantity', function ($query) {
                  $query->where('status', 'wastage');
              })
              ->addSelect([
                  'quantity_left' => Product::selectRaw('COALESCE(ordered_quantity, 0) - COALESCE(sold_quantity, 0) - COALESCE(wastage_quantity, 0)')->limit(1)
              ]);

        // Apply product filter if it's provided
        if ($productFilter) {
            $query->where('name', 'like', '%' . $productFilter . '%');
        }

    }])
    ->when($franchiseFilter, function ($query) use ($franchiseFilter) {
        // Apply franchise filter if it's provided
        return $query->where('franchises.name', 'like', '%' . $franchiseFilter . '%');
    })
    ->paginate(10); // Paginate results, 10 products per page

    return view('sales_report', compact('report'));
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
