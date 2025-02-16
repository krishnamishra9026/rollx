<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderHistory;
use App\Models\Franchise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Facades\Larafirebase;

class PurchaseOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:franchise');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter                     = [];
        $filter['order_date']       = $request->order_date;
        $filter['model_number']     = $request->model_number;
        $filter['due_date']         = $request->due_date;
        $filter['created_at']       = $request->created_at;
        $filter['status']           = $request->status;

        $orders              = PurchaseOrder::query();
        $orders              = isset($filter['order_date']) ? $orders->whereDate('order_date', $filter['order_date']) : $orders;
        $orders              = isset($filter['status']) ? $orders->where('status', $filter['status']) : $orders;
        $orders              = isset($filter['due_date']) ? $orders->where('due_date', $filter['due_date']) : $orders;
        $orders              = isset($filter['model_number']) ? $orders->where('model_number', $filter['model_number']) : $orders;
        $orders              = isset($filter['created_at']) ? $orders->whereDate('created_at', $filter['created_at']) : $orders;
        $orders              = $orders->orderBy("id", "desc")->paginate(20);
        return view('franchise.purchase-orders.list', compact('orders', 'filter'));
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
        $purchase_order     = PurchaseOrder::find($id);

        return view('franchise.purchase-orders.show', compact('purchase_order', 'id'));
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

    public function addHistory(Request $request, $id)
    {

        $purchase_order = PurchaseOrder::find($id);
        PurchaseOrderHistory::create([
            'purchase_order_id' => $id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'franchise',
            'status_changer_id' => Auth::user()->id
        ]);



        PurchaseOrder::find($id)->update([
            'status' => $request->status,
        ]);


        $administrators = Administrator::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('Puchase Order Status Updated')
        ->withBody('Status for Purchase Order#'.$id.  ' has been changed to '.$request->status.'!')
        ->sendMessage($administrators);

        return redirect()->back()->with('success', 'Order History added successfully');
    }

    public function changeStatus(Request $request){
        $purchase_order = PurchaseOrder::find($request->order_id);
        PurchaseOrderHistory::create([
            'purchase_order_id' => $request->order_id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'franchise',
            'status_changer_id' => Auth::user()->id
        ]);



        PurchaseOrder::find($request->order_id)->update([
            'status' => $request->status,
        ]);


        $administrators = Administrator::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('Puchase Order Status Updated')
        ->withBody('Status for Purchase Order#'.$request->order_id.  ' has been changed to '.$request->status.'!')
        ->sendMessage($administrators);
        return response()->json(['success' => 'Order status changed successfully!'], 200);
    }
}
