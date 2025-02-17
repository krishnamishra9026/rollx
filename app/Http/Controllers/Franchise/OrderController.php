<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderHistory;
use Auth;

class OrderController extends Controller
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
        $filter['order_date']       = $request->order_date;
        $filter['model_number']     = $request->model_number;
        $filter['due_date']         = $request->due_date;
        $filter['created_at']       = $request->created_at;
        $filter['status']           = $request->status;
        $filter['product']           = $request->product;

        $orders              = Order::where('franchise_id', auth()->user()->id);
        $orders              = isset($filter['order_date']) ? $orders->whereDate('order_date', $filter['order_date']) : $orders;
        $orders              = isset($filter['status']) ? $orders->where('status', $filter['status']) : $orders;
        $orders              = isset($filter['due_date']) ? $orders->where('due_date', $filter['due_date']) : $orders;
        $orders              = isset($filter['model_number']) ? $orders->where('model_number', $filter['model_number']) : $orders;
        $orders              = isset($filter['created_at']) ? $orders->whereDate('created_at', $filter['created_at']) : $orders;
        $orders              = isset($filter['product']) ? $orders->where('product_id',  $filter['product'] ) : $orders;
        $orders              = $orders->where('franchise_id', auth()->user()->id)->orderBy("id", "desc")->paginate(20);

        $products = Product::all();

        return view('franchise.orders.list', compact('orders', 'filter', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('franchise.orders.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function save(Request $request)
    {

        foreach ($request->data as $key => $value) {                  

            if ($value['quantity'] <= 0) {
                continue;
            }

            $product = Product::find($value['product_id']);

            $input = [];

            $total = $product->price * $value['quantity'];

            $user = auth()->user();

            $input['product_id'] = $product->id;
            $input['sub_total'] = $product->price;
            $input['product_name'] = $product->name;
            $input['model_number'] = $product->model_number;
            $input['stock'] = $value['quantity'];
            $input['quantity'] = $value['quantity'];
            $input['product_price'] = $product->price;
            $input['total_price'] = $total;
            $input['franchise_id'] = auth()->user()->id;
            $input['total'] = $product->price * $value['quantity'];

            $order = Order::create($input);

            $user->wallet->withdraw($total, ['description' => 'Purchase of Product Id #'.$product->id.' Order Id #'.$order->id]);

        }

        return redirect()->route('franchise.orders.index')->with('success', 'Order added successfully');

        return response()->json(['success' => 'Order added successfully!'], 200);
    }

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
        $input['product_name'] = $product->name;
        $input['model_number'] = $product->model_number;
        $input['stock'] = $request->quantity;
        $input['product_price'] = $product->price;
        $input['total_price'] = $total;
        $input['franchise_id'] = auth()->user()->id;
        $input['total'] = $product->price * $request->quantity;

        $order = Order::create($input);

        $user->wallet->withdraw($total, ['description' => 'Purchase of Product Id #'.$product->id.' Order Id #'.$order->id]);

        return redirect()->route('franchise.orders.index')->with('success', 'Order added successfully');
    }

    public function changeStatus(Request $request){

        $order = Order::find($request->order_id);

        OrderHistory::create([
            'order_id' => $request->order_id,
            'status'   => $request->status,
            'comment'  => $request->comment ?? '',
            'status_changed_by' => 'franchise',
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
            'status_changed_by' => 'franchise',
            'status_changer_id' => Auth::user()->id
        ]);

        Order::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order History added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order     = Order::find($id);

        return view('franchise.orders.show', compact('order', 'id'));
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
