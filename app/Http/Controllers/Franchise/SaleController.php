<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\ProductPrice;
use App\Models\Chef;
use App\Models\Administrator;
use App\Notifications\OrderSaleNotification;

use App\Exports\Franchise\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
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
        $filter['date']       = $request->date;
        $filter['status']           = $request->status;
        $filter['product']           = $request->product;
        $filter['order']           = $request->order;
        $filter['chef']           = $request->chef;

        $order_id = $request->order_id;

        if (isset($order_id)) {
            $sales          = Sale::where('order_id', $order_id)->with('order', 'product');
        }else{
            $sales          = Sale::with('order', 'product');
        }
        $sales              = isset($filter['date']) ? $sales->whereDate('created_at', $filter['date']) : $sales;
        $sales              = isset($filter['status']) ? $sales->where('status', 'LIKE', '%' . $filter['status'] . '%') : $sales;
        $sales              = isset($filter['product']) ? $sales->where('product_id',  $filter['product'] ) : $sales;
        $sales              = isset($filter['order']) ? $sales->where('order',  $filter['order'] ) : $sales;
        $sales              = isset($filter['chef']) ? $sales->where('chef_id',  $filter['chef'] ) : $sales;
        $sales              = $sales->where('franchise_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20);            

        $order = Order::where('id', $order_id)->first();

        $orders = Order::latest()->get();
        $products = Product::latest()->get();
        $chefs = Chef::latest()->get();

        return view('franchise.orders.sales.list', compact('sales', 'filter', 'order', 'order_id', 'orders', 'products', 'chefs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $order_id = $request->order_id;

        if (!isset($order_id)) {

            $orders  = Order::where('franchise_id', auth()->user()->id)->where('stock', '>', 0)
            ->where(function ($query) {
                $query->where('status', 'completed')
                      ->orWhere('status', 'delivered');
            })->get(['id']);       

            return view('franchise.orders.sales.create-sale', compact('orders'));
        }

        $order = Order::where('id', $order_id)->first();

        return view('franchise.orders.sales.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {                          
                                              
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($request->quantity > $order->stock) {
            return back()->with('error', 'Not enough stock available');
        }

        $order->stock -= $request->quantity;
        $order->save();

        $product_id = $order->product_id;
        $franchise_id = auth()->user()->id;

        $price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('price') ?? $order->product_price;
        
        $sale_price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('sale_price') ?? $order->product_price;   
        
        $sale = Sale::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'franchise_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'price' => $request->quantity * $sale_price,
            'product_price' => $price,
            'sale_price' => $order->product_price,
            'status' => $request->status == 'Sold' ? 'Sold' : 'Wastage'
        ]);


        //Sale created notification

        $admins = Administrator::role(['Operations', 'Administrator'])->get();

        foreach ($admins as $admin) {
            $admin->notify(new OrderSaleNotification($sale));
        }

        return redirect()->route('franchise.order.sales.index', ['order_id' => $order->id])->with('success', 'Sale recorded successfully');
    }

    public function export(Request $request)
    {              
        $filters = $request->only(['status', 'order_date', 'product', 'order']);
        return Excel::download(new SalesExport($filters), 'sales.xlsx');
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
