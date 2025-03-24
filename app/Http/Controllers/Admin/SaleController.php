<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Chef;

use App\Exports\Admin\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
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

        $order_id = $request->order;

        if (isset($order_id)) {
            $sales = Sale::where('order_id', $order_id)->with('order', 'product');
        }

        $sales              = Sale::with('order', 'product', 'franchise', 'chef');
        $sales              = isset($filter['date']) ? $sales->whereDate('created_at', $filter['date']) : $sales;
        $sales              = isset($filter['status']) ? $sales->where('status', 'LIKE', '%' . $filter['status'] . '%') : $sales;
        $sales              = isset($filter['franchise']) ? $sales->where('franchise_id',  $filter['franchise'] ) : $sales;
        $sales              = isset($filter['chef']) ? $sales->where('chef_id',  $filter['chef'] ) : $sales;
        $sales              = isset($filter['product']) ? $sales->where('product_id',  $filter['product'] ) : $sales;
        $sales              = isset($filter['order']) ? $sales->where('order_id',  $filter['order'] ) : $sales;

        $sales              = $sales->orderBy('created_at', 'desc')->paginate(20);             


        $order = Order::where('id', $order_id)->first();

        $orders = Order::latest()->get();
        $products = Product::latest()->get();
        $franchises = Franchise::latest()->get();
        $chefs = Chef::latest()->get();              

        return view('admin.orders.sales.list', compact('sales', 'filter', 'order', 'order_id', 'orders', 'products', 'chefs', 'franchises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $order_id = $request->order_id;

        if (!isset($order_id)) {

            $orders = Order::latest()->get();

            return view('admin.orders.sales.create-sale', compact('orders'));
        }

        $order = Order::where('id', $order_id)->first();

        return view('admin.orders.sales.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {                            
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($request->quantity > $order->stock) {
            return back()->with('error', 'Not enough stock available');
        }

        $order->stock -= $request->quantity;
        $order->save();

        Sale::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'franchise_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'price' => $request->quantity * $request->price,
            'status' => 'Sold'
        ]);

        return redirect()->route('admin.order.sales.index', ['order_id' => $order->id])->with('success', 'Sale recorded successfully');
    }

    /**
     * Display the specified resource.
     */

    public function export(Request $request)
    {                            
        $filters = $request->only(['status', 'order_date', 'product', 'order']);
        return Excel::download(new SalesExport($filters), 'sales.xlsx');
    }

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
