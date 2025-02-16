<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter                     = [];
        $filter['date']       = $request->date;
        $filter['status']           = $request->status;

        $order_id = $request->order_id;


        $sales              = Sale::with('order', 'product');
        $sales              = isset($filter['date']) ? $sales->whereDate('created_at', $filter['date']) : $sales;
        $sales              = isset($filter['status']) ? $sales->where('status', 'LIKE', '%' . $filter['status'] . '%') : $sales;

        $sales              = $sales->orderBy('id', 'desc')->paginate(20);


        $order = Order::where('id', $order_id)->first();

        return view('chef.orders.sales.list', compact('sales', 'filter', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $order_id = $request->order_id;

        if (!isset($order_id)) {

            $orders = Order::latest()->get();

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
            'quantity' => $request->quantity,
            'price' => $request->quantity * $request->price,
            'status' => 'Sold'
        ]);

        return redirect()->route('chef.order.sales.index', ['order_id' => $order->id])->with('success', 'Sale recorded successfully');
    }

    public function save(Request $request)
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
