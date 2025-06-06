<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\Administrator;
use App\Models\Sale;
use App\Models\ProductPrice;
use App\Notifications\OrderSaleNotification;

use App\Exports\Chef\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:chef');
    }

    public function index(Request $request)
    {
        $filter                     = [];
        $filter['date']       = $request->date;
        $filter['status']           = $request->status;
        $filter['product']           = $request->product;
        $filter['order']           = $request->order;

        $order_id = $request->order_id;
        $sales              = Sale::with('order', 'product');

        if (isset($order_id)) {
            $sales              = Sale::where('order_id', $order_id)->with('order', 'product');
        }
        $sales              = isset($filter['date']) ? $sales->whereDate('created_at', $filter['date']) : $sales;
        $sales              = isset($filter['status']) ? $sales->where('status', 'LIKE', '%' . $filter['status'] . '%') : $sales;
        $sales              = isset($filter['product']) ? $sales->where('product_id',  $filter['product'] ) : $sales;
        $sales              = isset($filter['order']) ? $sales->where('order_id',  $filter['order'] ) : $sales;

        $sales              = $sales->where('franchise_id', auth()->user()->franchise_id)->where('chef_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20);


        $order = Order::where('id', $order_id)->first();

        $orders = Order::latest()->get();
        $products = Product::latest()->get();

        return view('chef.orders.sales.list', compact('sales', 'filter', 'order', 'order_id', 'orders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function wastageSale(Request $request)
    {
       $total_orders = Order::count();
       $not_started = Order::where('status', 'PO Generated')->count();
       $in_progress = Order::where('status', 'In Progress')->count();
       $delivered = Order::where('status', 'Delivered')->count();
       $completed = Order::where('status', 'Completed')->count();

       $orders = Order::where('franchise_id', auth()->user()->franchise_id)
           ->where('stock', '>', 0)
           ->whereHas('product', function ($query) {
                $query->where('customer_sale', 1);
            })
           ->where(function ($query) {
                $query->where('status', 'completed')
            ->orWhere('status', 'delivered');
            })
               ->orderBy("id", "desc")
               ->with(['productPlateSetting' => function ($query) {
                    $query->select('product_id', 'franchise_id', 'full_plate_quantity', 'half_plate_quantity');
            }])
        ->paginate(20);      

        return view('chef.orders.sales.wastage', compact('total_orders', 'not_started', 'in_progress', 'delivered', 'completed', 'orders'));     
    }

    public function create(Request $request)
    {
        $order_id = $request->order_id;

        if (!isset($order_id)) {

            $orders  = Order::where('franchise_id', auth()->user()->franchise_id)->where('stock', '>', 0)
                    ->where(function ($query) {
                        $query->where('status', 'completed')
                              ->orWhere('status', 'delivered');
                    })->get(['id']);                          

            return view('chef.orders.sales.create-sale', compact('orders'));
        }

        $order = Order::where('id', $order_id)->first();

        return view('chef.orders.sales.create', compact('order'));
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
        $franchise_id = $order->franchise_id;

        $price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('price') ?? $order->product_price;
        
        $sale_price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('sale_price') ?? $order->product_price; 

        $sale = Sale::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'franchise_id' => $order->franchise_id,
            'chef_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'price' => $request->quantity * $sale_price,
            'product_price' => $price,
            'sale_price' => $order->product_price,
            'status' => $request->status ?? 'Sold'
        ]);

        //Sale created notification

        $admins = Administrator::role(['Operations', 'Administrator'])->get();

        foreach ($admins as $admin) {
            $admin->notify(new OrderSaleNotification($sale));
        }

         $franchise = Franchise::find($sale->franchise_id);

         $franchise->notify(new OrderSaleNotification($sale, 'franchise'));

         if ($sale->status == 'Sold') {
            return redirect()->route('chef.order.sales.index', ['order_id' => $order->id])->with('success', 'Sold quantity Sale recorded successfully');            
        }

        return redirect()->route('chef.order.sales.index', ['order_id' => $order->id])->with('success', 'Wastage quantity Sale recorded successfully');
    }

    public function save(Request $request)
    {                              
        $order = Order::findOrFail($request->order_id);

        if ($request->quantity > $order->stock) {
            return back()->with('error', 'Not enough stock available');
        }

        $order->stock -= $request->quantity;
        $order->save();

        $product_id = $order->product_id;
        $franchise_id = $order->franchise_id;

        $price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('price') ?? $order->product_price;
        
        $sale_price = ProductPrice::where(['product_id' => $product_id, 'franchise_id' => $franchise_id])->value('sale_price') ?? $order->product_price; 

        $sale = Sale::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'franchise_id' => $order->franchise_id,
            'chef_id' => auth()->user()->id,
            'quantity' => $request->quantity,
            'price' => $request->quantity * $sale_price,
            'product_price' => $price,
            'sale_price' => $sale_price,
            'status' => $request->status ?? 'Sold'
        ]);

        //Sale created notification

        $admins = Administrator::role(['Operations', 'Administrator'])->get();

        foreach ($admins as $admin) {
            $admin->notify(new OrderSaleNotification($sale));
        }

        $franchise = Franchise::find($sale->franchise_id);

        $franchise->notify(new OrderSaleNotification($sale));

        if ($sale->status == 'Sold') {
            return redirect()->back()->with('success', 'Sold quantity Sale recorded successfully');            
        }

        return redirect()->back()->with('success', 'Wastage quantity Sale recorded successfully');
    }

    public function saveOld(Request $request)
    {                         
        $order = Order::findOrFail($request->id);

        if ($request->quantity > $order->stock) {
            return back()->with('error', 'Not enough stock available');
        }

        $order->stock -= $request->quantity;
        $order->save();

        Sale::create([
            'order_id' => $order->id,
            'product_id' => $order->product_id,
            'quantity' => $request->quantity,
            'price' => $request->quantity * $request->price,
            'status' => 'Sold'
        ]);

        return 1;
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
