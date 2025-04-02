<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;
use DB;
use App\Exports\Franchise\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class DateWiseSaleReportController extends Controller
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

        $filter                     = [];
        $filter['start_date']       = $request->start_date;
        $filter['date']       = $request->date;
        $filter['end_date']       = $request->end_date;
        $filter['product']           = $request->product;
        $product = $request->product;
        $start_date = $request->start_date;
        $date = $request->date;
        $end_date = $request->end_date;


        $startDate = request()->input('start_date'); 
        $endDate = request()->input('end_date'); 
        $productId = request()->input('product'); 

        $salesQuery = Sale::where('sales.franchise_id', auth()->user()->id)
            ->selectRaw(
                'DATE(sales.created_at) as sale_date, 
                 products.name as product_name, 
                 products.id as product_id,
                 COALESCE(order_quantities.ordered_quantity, 0) as ordered_quantity,
                 COALESCE(SUM(CASE WHEN sales.status = "Sold" THEN sales.quantity ELSE 0 END), 0) as sold_quantity,
                 COALESCE(SUM(CASE WHEN sales.status = "Wastage" THEN sales.quantity ELSE 0 END), 0) as wastage_quantity,
                 (COALESCE(order_quantities.ordered_quantity, 0) - 
                 (COALESCE(SUM(CASE WHEN sales.status = "Sold" THEN sales.quantity ELSE 0 END), 0) + 
                 COALESCE(SUM(CASE WHEN sales.status = "Wastage" THEN sales.quantity ELSE 0 END), 0))) as left_quantity'
            )
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->leftJoinSub(
                DB::table('orders')
                    ->selectRaw('product_id, DATE(created_at) as order_date, SUM(quantity) as ordered_quantity')
                    ->whereIn('status', ['completed', 'delivered'])
                    ->groupBy('product_id', 'order_date'),
                'order_quantities',
                function ($join) {
                    $join->on('order_quantities.product_id', '=', 'sales.product_id')
                         ->whereRaw('order_quantities.order_date = DATE(sales.created_at)');
                }
            )
            ->groupByRaw('DATE(sales.created_at), products.name, products.id, order_quantities.ordered_quantity')
            ->orderBy('sales.created_at', 'DESC');

        if ($startDate && $endDate) {
            $salesQuery->whereBetween('sales.created_at', [$startDate, $endDate]);
        }

        if ($date) {
            $salesQuery->whereDate('sales.created_at', $date);
        }

        if ($productId) {
            $salesQuery->where('sales.product_id', $productId);
        }

        $sales = $salesQuery->paginate(20);


              echo '<pre>'; print_r($sales->toArray()); echo '</pre>'; exit();
                                                                          

        $products = Product::latest()->get();

        return view('franchise.products.sales.reports.list', compact('sales', 'filter', 'products'));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $product = $request->input('product');


        return Excel::download(new SalesReportExport($startDate, $endDate, $status, $product), 'sales_report.xlsx');
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
