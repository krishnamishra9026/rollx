<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\Order;
use App\Models\OrderDocument;
use App\Models\OrderHistory;
use App\Models\OrderImage;
use App\Models\OrderPart;
use App\Models\Part;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDocument;
use App\Models\PurchaseOrderHistory;
use App\Models\PurchaseOrderImage;
use App\Models\Supplier;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kutia\Larafirebase\Facades\Larafirebase;

class PurchaseOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:administrator');
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
        return view('admin.purchase-orders.list', compact('orders', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.purchase-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'project_reference'     => ['required', 'string', 'max:255'],
            'model_number'          => ['required', 'string', 'max:255'],
            'quantity'              => ['required'],
            'order_date'            => ['required'],
            'due_date'              => ['required'],
            'remarks'               => ['required'],

        ];

        $messages = [
            'project_reference.required'            => 'Please enter Project reference',
            'model_number.required'                 => 'Please enter Model number.',
            'quantity.required'                     => 'Please enter quantity.',
            'order_date.required'                   => 'Please enter Order date.',
            'due_date.required'                     => 'Please choose Due date.',
            'remarks.required'                      => 'Please enter remarks.',
        ];

        $this->validate($request, $rules, $messages);

        $order = PurchaseOrder::create([
            "supplier_id"       => 1,
            "project_reference" => $request->project_reference,
            "model_number"      => $request->model_number,
            "quantity"          => $request->quantity,
            "remarks"           => $request->remarks,
            "due_date"          => $request->due_date,
            "order_date"        => Carbon::parse($request->order_date)->format("Y-m-d"),
            "suplier_remarks"   => null,
            "percentage"        => null,
            "status"            => "PO Generated"
        ]);

        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $document_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/purchase-orders/'.$order->id.'/documents', $document_name, 'public');
                PurchaseOrderDocument::create([
                    'purchase_order_id' => $order->id,
                    'name'     => $document_name
                ]);
            }
         }

        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $image_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/purchase-orders/'.$order->id.'/images', $image_name, 'public');
                PurchaseOrderImage::create([
                    'purchase_order_id' => $order->id,
                    'name'     => $image_name
                ]);
            }
         }

         PurchaseOrderHistory::create([
            'purchase_order_id' => $order->id,
            'status'   => 'PO Generated',
            'comment'  => 'Purchase Order#'.$order->id.  ' has been generated!',
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order created successfully');
    }

    public function clone(string $id)
    {

        $order              = PurchaseOrder::find($id);
        $newOrder = PurchaseOrder::create([
           "supplier_id"        => 1,
            "project_reference" => $order->project_reference,
            "model_number"      => $order->model_number,
            "quantity"          => $order->quantity,
            "remarks"           => $order->remarks,
            "due_date"          => $order->due_date,
            "order_date"        => $order->order_date,
            "suplier_remarks"   => null,
            "percentage"        => null,
            "status"            => "PO Generated"
        ]);

        if(count($order->documents) > 0){
            foreach($order->documents as $document)
            {
                Storage::copy('public/uploads/purchase-orders/'.$order->id.'/documents'.'/'.$document->name, 'public/uploads/purchase-orders/'.$newOrder->id.'/documents'.'/'.$document->name);
                PurchaseOrderDocument::create([
                    'purchase_order_id' => $newOrder->id,
                    'name'     => $document->name
                ]);
            }
        }

        if(count($order->images) > 0){
            foreach($order->images as $image)
            {
                Storage::copy('public/uploads/purchase-orders/'.$order->id.'/images'.'/'.$image->name, 'public/uploads/purchase-orders/'.$newOrder->id.'/images'.'/'.$image->name);
                PurchaseOrderImage::create([
                    'purchase_order_id' => $newOrder->id,
                    'name'     => $image->name
                ]);
            }
        }

        PurchaseOrderHistory::create([
            'purchase_order_id' => $newOrder->id,
            'status'   => 'PO Generated',
            'comment'  => 'Purchase Order#'.$newOrder->id.  ' has been generated!',
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Purchase Order cloned successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase_order     = PurchaseOrder::find($id);

        return view('admin.purchase-orders.show', compact('purchase_order', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase_order     = PurchaseOrder::find($id);

        return view('admin.purchase-orders.edit', compact('purchase_order', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'project_reference'     => ['required', 'string', 'max:255'],
            'model_number'          => ['required', 'string', 'max:255'],
            'quantity'              => ['required'],
            'order_date'            => ['required'],
            'due_date'              => ['required'],
            'remarks'               => ['required'],

        ];

        $messages = [
            'project_reference.required'            => 'Please enter Project reference',
            'model_number.required'                 => 'Please enter Model number.',
            'quantity.required'                     => 'Please enter quantity.',
            'order_date.required'                   => 'Please enter Order date.',
            'due_date.required'                     => 'Please choose Due date.',
            'remarks.required'                      => 'Please enter remarks.',
        ];

        $this->validate($request, $rules, $messages);

        $order = PurchaseOrder::find($id)->update([
            "supplier_id"       => 1,
            "project_reference" => $request->project_reference,
            "model_number"      => $request->model_number,
            "quantity"          => $request->quantity,
            "remarks"           => $request->remarks,
            "due_date"          => $request->due_date,
            "order_date"        => Carbon::parse($request->order_date)->format("Y-m-d"),
        ]);

        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $document_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/purchase-orders/'.$id.'/documents', $document_name, 'public');
                PurchaseOrderDocument::create([
                    'purchase_order_id' => $id,
                    'name'     => $document_name
                ]);
            }
         }

        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $image_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/purchase-orders/'.$id.'/images', $image_name, 'public');
                PurchaseOrderImage::create([
                    'purchase_order_id' => $id,
                    'name'     => $image_name
                ]);
            }
         }

        return redirect()->route('admin.purchase-orders.index')->with('success', 'Purchase Order updated successfully');
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
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);



        PurchaseOrder::find($id)->update([
            'status' => $request->status,
        ]);

        $suppliers = Supplier::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('Puchase Order Status Updated')
        ->withBody('Status for Purchase Order#'.$id.' has been changed to '.$request->status.'!')
        ->sendMessage($suppliers);

        return redirect()->back()->with('success', 'Order History added successfully');
    }

    public function deleteImage(Request $request, $id){
        PurchaseOrderImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteDocument(Request $request, $id){
        PurchaseOrderDocument::find($id)->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }

    public function changeStatus(Request $request){
        $purchase_order = PurchaseOrder::find($request->order_id);
        PurchaseOrderHistory::create([
            'purchase_order_id' => $request->order_id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);



        PurchaseOrder::find($request->order_id)->update([
            'status' => $request->status,
        ]);

        $suppliers = Supplier::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('Puchase Order Status Updated')
        ->withBody('Status for Purchase Order#'.$request->order_id.' has been changed to '.$request->status.'!')
        ->sendMessage($suppliers);
        return response()->json(['success' => 'Order status changed successfully!'], 200);
    }
}
