<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\Order;
use App\Models\OrderHistory;
use Auth;

use App\Exports\Chef\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
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
        $filter['order_date']       = $request->order_date;
        $filter['model_number']     = $request->model_number;
        $filter['due_date']         = $request->due_date;
        $filter['created_at']       = $request->created_at;
        $filter['status']           = $request->status;
        $filter['product']           = $request->product;

        $orders              = Order::where('franchise_id', auth()->user()->franchise_id)
                                    ->where(function ($query) {
                                        $query->where('status', 'completed')
                                              ->orWhere('status', 'delivered');
                                    });

        $orders              = isset($filter['order_date']) ? $orders->whereDate('order_date', $filter['order_date']) : $orders;
        $orders              = isset($filter['status']) ? $orders->where('status', $filter['status']) : $orders;
        $orders              = isset($filter['due_date']) ? $orders->where('due_date', $filter['due_date']) : $orders;
        $orders              = isset($filter['model_number']) ? $orders->where('model_number', $filter['model_number']) : $orders;
        $orders              = isset($filter['product']) ? $orders->where('product_id',  $filter['product'] ) : $orders;
        $orders              = isset($filter['created_at']) ? $orders->whereDate('created_at', $filter['created_at']) : $orders;
        $orders              = $orders->orderBy("id", "desc")->paginate(20);

        $products = Product::latest()->get();

        return view('chef.orders.list', compact('orders', 'filter', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('chef.orders.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity'            => ['required'],
        ]);

        $product = Product::find($request->product_id);

        $input = $request->except('_token');

        $total = $product->price * $request->quantity;

        $user = auth()->user();

        if ($user->wallet->balance < $total) {
            return redirect()->back()->with('error', 'Your wallet balance is not sufficent to place order!');
        }

        $input['sub_total'] = $product->price;
        $input['stock'] = $request->quantity;
        $input['product_price'] = $product->price;
        $input['total_price'] = $total;
        $input['chef_id'] = auth()->user()->id;
        $input['total'] = $product->price * $request->quantity;

        $order = Order::create($input);

        $product_url = route('admin.products.show', $order->product_id);
        $order_url = route('admin.orders.show', $order->id);

        $franchise = Franchise::find(auth()->user()->franchise_id); 

        $franchise->wallet->withdraw($total, [
            'description' => 'Purchase of Product Id <a href="'.$product_url.'"> #'.$order->product_id.'</a> 
            Order Id <a href="'.$order_url.'">#'.$order->id.'</a>',
                'balance' => $franchise->wallet->balance - $total
        ]);

        return redirect()->route('chef.orders.index')->with('success', 'Order added successfully');
    }

    public function changeStatus(Request $request){

        $order = Order::find($request->order_id);

        OrderHistory::create([
            'order_id' => $request->order_id,
            'status'   => $request->status,
            'comment'  => $request->comment ?? '',
            'status_changed_by' => 'chef',
            'status_changer_id' => Auth::user()->id
        ]);

        Order::find($request->order_id)->update([
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Order status changed successfully!'], 200);
    }


    public function addHistory(Request $request, $id)
    {
        $order = Order::find($id);
        OrderHistory::create([
            'order_id' => $id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'chef',
            'status_changer_id' => Auth::user()->id
        ]);

        Order::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order History added successfully');
    }

    public function export(Request $request)
    {              
        $filters = $request->only(['status', 'order_date', 'product', 'order']);
        return Excel::download(new OrdersExport($filters), 'orders.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order     = Order::find($id);

        return view('chef.orders.show', compact('order', 'id'));
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
