<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDocument;
use App\Models\OrderHistory;
use App\Models\OrderImage;
use App\Models\OrderPart;
use App\Models\Franchise;
use App\Models\User;
use App\Models\Chef;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Notifications\OrderStatusNotification;

use App\Exports\Admin\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
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
        $filter['date']             = $request->date;
        $filter['status']           = $request->status;
        $filter['product']           = $request->product;
        $filter['franchise']           = $request->franchise;

        $orders              = Order::query();
        $orders              = isset($filter['date']) ? $orders->where('date', $filter['date']) : $orders;
        $orders              = isset($filter['status']) ? $orders->where('status', 'LIKE', '%' . $filter['status'] . '%') : $orders;
        $orders              = isset($filter['product']) ? $orders->where('product_id',  $filter['product'] ) : $orders;
        $orders              = isset($filter['franchise']) ? $orders->where('franchise_id',  $filter['franchise'] ) : $orders;

        $orders              = $orders->orderBy('id', 'desc')->paginate(20);

        $products = Product::all();
        $franchises = Franchise::all();
        
        return view('admin.orders.list', compact('orders', 'filter', 'products', 'franchises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        session()->forget('route');
        if($request->has("customer_id")){
            $customer = User::with("orders")->find($request->customer_id);
            if(count($customer->orders) > 0){
                $project_name = Order::where("user_id", $request->customer_id)->first()->project_name;
            }else{
                $project_name = null;
            }
        }else{
            $project_name = null;
        }


        $customers          = User::get();
        return view('admin.orders.create', compact('customers', 'project_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            // 'serial_number'                     => ['required'],
            'equipment_assemble_type'           => ['required', 'string', 'max:255'],
            'customer'                          => ['required'],
            'address'                           => ['required'],
            'date'                              => ['required'],
            'order_delivery_upto'               => ['required'],
            'quotation_reference'               => ['required'],
        ];

        $messages = [
            'serial_number.required'            => 'Please enter Serial Number',
            'equipment_assemble_type.required'  => 'Please choose equipment assemble type.',
            'project_name.required'             => 'Please enter project name.',
            'customer.required'                 => 'Please choose customer / company.',
            'address.required'                  => 'Please choose customer / company address.',
            'date.required'                     => 'Please choose order date.',
            'order_delivery_upto.required'      => 'Please choose order delivery upto.',
            'quotation_reference.required'      => 'Plese enter quotation Reference'
        ];

        $this->validate($request, $rules, $messages);

        $order = Order::create([
            'serial_number'             => $request->serial_number ? $request->serial_number : null,
            'equipment_assemble_type'   => $request->equipment_assemble_type,
            'project_name'              => $request->project_name,
            'user_id'                   => $request->customer,
            'user_address_id'           => $request->address,
            'date'                      => Carbon::parse($request->date)->format("Y-m-d"),
            'order_delivery_upto'       => $request->order_delivery_upto,
            'description'               => $request->description,
            'quotation_reference'       => $request->quotation_reference,
            'remarks'                   => $request->remarks,
        ]);

        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $document_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/orders/'.$order->id.'/documents', $document_name, 'public');
                OrderDocument::create([
                    'order_id' => $order->id,
                    'name'     => $document_name
                ]);
            }
         }

        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $image_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/orders/'.$order->id.'/images', $image_name, 'public');
                OrderImage::create([
                    'order_id' => $order->id,
                    'name'     => $image_name
                ]);
            }
         }

        return redirect()->route('admin.orders.equipment-info', $order->id)->with('success', 'Order created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $order              = Order::find($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $order              = Order::find($id);
        $customers          = User::get();
        $addresses          = UserAddress::where('user_id', $order->user_id)->get();
        return view('admin.orders.edit.order-info', compact('customers', 'order', 'addresses'));
    }

    public function clone(string $id)
    {

        $order              = Order::find($id);
        $newOrder = Order::create([
            'serial_number'             => $order->serial_number ? $order->serial_number : null,
            'equipment_assemble_type'   => $order->equipment_assemble_type,
            'project_name'              => $order->project_name,
            'user_id'                   => $order->user_id,
            'user_address_id'           => $order->user_address_id,
            'date'                      => $order->date,
            'order_delivery_upto'       => $order->order_delivery_upto,
            'description'               => $order->description,
            'equipment_name'            => $order->equipment_name,
            'installation_date'         => $order->installation_date,
            'warranty_upto'             => $order->warranty_upto,
            'service_contract'          => $order->service_contract,
            'service_start_date'        => $order->service_start_date,
            'service_interval'          => $order->service_interval,
            'quotation_reference'       => $order->quotation_reference,
            'remarks'                   => $order->remarks,
        ]);

        if(count($order->documents) > 0){
            foreach($order->documents as $document)
            {
                Storage::copy('public/uploads/orders/'.$order->id.'/documents'.'/'.$document->name, 'public/uploads/orders/'.$newOrder->id.'/documents'.'/'.$document->name);
                OrderDocument::create([
                    'order_id' => $newOrder->id,
                    'name'     => $document->name
                ]);
            }
        }

        if(count($order->images) > 0){
            foreach($order->images as $image)
            {
                Storage::copy('public/uploads/orders/'.$order->id.'/images'.'/'.$image->name, 'public/uploads/orders/'.$newOrder->id.'/images'.'/'.$image->name);
                OrderImage::create([
                    'order_id' => $newOrder->id,
                    'name'     => $image->name
                ]);
            }
        }


        foreach($order->parts as $part){
            $quantity = Part::find($part->part_id)->quantity;

            $order_part = OrderPart::create([
                'order_id'                  => $newOrder->id,
                'part_id'                   => $part->part_id,
                'quantity'                  => $part->quantity,
                'installation_date'         => $part->part_installation_date,
                'warranty_upto'             => $part->part_warranty_upto,
                'available'                 => $part->quantity < $quantity ? true : false
            ]);
        }

        return redirect()->back()->with('success', 'Order cloned successfully');
    }



    public function equipmentInfo($id){

        $order              = Order::find($id);
        $categories         = Category::whereType('category')->get();
        $equipments         = InventoryEquipment::get();
        return view('admin.orders.edit.equipment-info', compact('categories', 'order', 'equipments'));

    }

    public function saveEquipmentInfo(Request $request, string $id)
    {

        $rules = [
            'type_of_equipment'            => ['required'],
            'existing_equipment'           => $request->type_of_equipment == "existing" ? ['required'] : [],
            'equipment_name'               => $request->type_of_equipment == "new" ? ['required'] : [],
            'warranty_upto'                => ['required'],
            'service_contract'             => ['required'],
        ];

        $messages = [
            'equipment_name.required'       => 'Please enter equipment name.',
            'warranty_upto.required'        => 'Please choose warranty up to  is required.',
            'service_contract.required'     => 'Please choose whether service contract is required.',
            'service_start_date.required'   => 'Please choose service start date.',
            'service_interval.required'     => 'Please choose service interval.',
        ];

        $this->validate($request, $rules, $messages);

        $order                      = Order::where('id', $id)->update([
            'type_of_equipment'     => $request->type_of_equipment,
            'existing_equipment'    => $request->type_of_equipment == "existing" ? InventoryEquipment::find($request->existing_equipment)->id : null,
            'equipment_name'        => $request->type_of_equipment == "existing" ? InventoryEquipment::find($request->existing_equipment)->equipment_name : $request->equipment_name,
            'installation_date'     => Carbon::parse($request->installation_date)->format("Y-m-d"),
            'warranty_upto'         => $request->warranty_upto,
            'warranty_date'         => Carbon::parse($request->warranty_date)->format("Y-m-d"),
            'service_contract'      => $request->service_contract,
            'service_start_date'    => $request->service_start_date ? Carbon::parse($request->service_start_date)->format("Y-m-d"): null,
            'service_interval'      => $request->service_interval ? $request->service_interval : null,
            'remarks'               => $request->remarks,

        ]);

        OrderPart::where("order_id", $id)->delete();
        $ls_order = Order::find($id);
        if($request->type_of_equipment == "existing" ){
            if($ls_order->equipment_assemble_type == "supplier"){
                $parts = InventoryEquipmentPart::where("inventory_equipment_id", $request->existing_equipment)->get();
                foreach($parts as $part){

                    $quantity = Part::find($part->part_id)->quantity;
                    $order_part = OrderPart::create([
                        'order_id'                  => $id,
                        'part_id'                   => $part->part_id,
                        'quantity'                  => $part->quantity,
                        'available'                 => $part->quantity < $quantity ? true : false
                    ]);

                    $serial_nos = PartSerialNo::where("part_id", $part->part_id)->where("deducted", false)->where("replaced", false)->take($part->quantity)->get();

                    foreach($serial_nos as $serial_no){
                        $serial_no->update([
                            'order_id' => $id,
                            'deducted' => true
                        ]);
                    }
                }
            }

            if($ls_order->equipment_assemble_type == "inventory"){

                Order::find($id)->update([
                    "serial_number" => $request->serial_number
                ]);

                InventoryEquipmentSerialNo::where("serial_no", $request->serial_number)->update(['deducted' => true]);

                $parts = InventoryEquipmentPart::where("inventory_equipment_id", $request->existing_equipment)->get();
                foreach($parts as $part){

                    $quantity = Part::find($part->part_id)->quantity;
                    $order_part = OrderPart::create([
                        'order_id'                  => $id,
                        'part_id'                   => $part->part_id,
                        'quantity'                  => $part->quantity,
                        'available'                 => $part->quantity < $quantity ? true : false
                    ]);

                }
            }

        }

        return redirect()->back()->with('success', 'Order updated successfully');
    }

    public function deleteEquipmentPart($id){
        OrderPart::find($id)->delete();
        return redirect()->back()->with('success', 'Part deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'equipment_assemble_type'           => ['required', 'string', 'max:255'],
            'customer'                          => ['required'],
            'address'                           => ['required'],
            'date'                              => ['required'],
            'order_delivery_upto'               => ['required'],
            'quotation_reference'               => ['required'],

        ];

        $messages = [
            'serial_number.required'            => 'Please enter Serial Number',
            'equipment_assemble_type.required'  => 'Please choose equipment assemble type.',
            'project_name.required'             => 'Please enter project name.',
            'customer.required'                 => 'Please choose customer / company.',
            'address.required'                  => 'Please choose customer / company address.',
            'date.required'                     => 'Please choose order date.',
            'order_delivery_upto.required'      => 'Please choose order delivery upto.',
            'quotation_reference.required'      => 'Please enter Quotation Reference '
        ];

        $this->validate($request, $rules, $messages);

        $order = Order::where('id', $id)->update([
            'equipment_assemble_type'   => $request->equipment_assemble_type,
            'project_name'              => $request->project_name,
            'user_id'                   => $request->customer,
            'user_address_id'           => $request->address,
            'date'                      => Carbon::parse($request->date)->format("Y-m-d"),
            'order_delivery_upto'       => $request->order_delivery_upto,
            'description'               => $request->description,
            'quotation_reference'       => $request->quotation_reference,
        ]);

        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $document_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/orders/'.$id.'/documents', $document_name, 'public');
                OrderDocument::create([
                    'order_id' => $id,
                    'name'     => $document_name
                ]);
            }
         }

        if($request->hasfile('images'))
         {
            foreach($request->file('images') as $file)
            {
                $image_name = time().rand(1,50).'.'.$file->extension();
                $file->storeAs('uploads/orders/'.$id.'/images', $image_name, 'public');
                OrderImage::create([
                    'order_id' => $id,
                    'name'     => $image_name
                ]);
            }
         }

         return redirect()->route('admin.orders.equipment-info', $id)->with('success', 'Order created successfully');
    }

    public function export(Request $request)
    {              
        $filters = $request->only(['status', 'order_date', 'product', 'order']);
        return Excel::download(new OrdersExport($filters), 'orders.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if($order->equipment_assemble_type == "inventory"){
            InventoryEquipmentSerialNo::where("serial_no", $order->serial_number)->update(['deducted' => false]);
        }
        Order::find($id)->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }


    public function addHistory(Request $request, $id)
    {
        $status = Order::find($id)->status;

        OrderHistory::create([
            'order_id' => $id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        $order = Order::find($id);

        if (!in_array($order->status, ['completed', 'delivered']) && in_array($request->status, ['completed', 'delivered'])) {
            Product::find($order->product_id)->increment('sold_quantity', $order->quantity);
            Product::find($order->product_id)->decrement('available_quantity', $order->quantity);
        }

        if (!in_array($order->status, ['cancelled']) && in_array($request->status, ['cancelled'])) {
            Product::find($order->product_id)->decrement('sold_quantity', $order->quantity);
            Product::find($order->product_id)->increment('available_quantity', $order->quantity);
        }

        Order::find($id)->update([
            'status' => $request->status,
        ]);

        if($request->status == 'cancelled'){
            $order = Order::find($id);

            $user = Franchise::find($order->franchise_id);

            $product_url = route('admin.products.show', $order->product_id);
            $order_url = route('admin.orders.show', $order->id);

            $user->wallet->deposit($order->total, [
                'description' => 'Return for Purchase of Product Id <a href="'.$product_url.'"> #'.$order->product_id.'</a> 
                Order Id <a href="'.$order_url.'">#'.$order->id.'</a>'
            ]);

        }

        $order = Order::find($id);

        //Order Status Notification

        $franchise_id = $order->franchise_id;

        $franchise = Franchise::find($franchise_id);

        $franchise->notify(new OrderStatusNotification($order, route('franchise.orders.show', $order->id)));

        if ($order->status == 'completed' || $order->status == 'delivered') {

            foreach ($franchise->chefs as $key => $chef) {
                $chef = Chef::find($chef->id);
                $chef->notify(new OrderStatusNotification($order, route('chef.orders.show', $order->id)));
            }
        }

        return redirect()->back()->with('success', 'Order History added successfully');
    }



     public function deleteImage(Request $request, $id){
        OrderImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteDocument(Request $request, $id){
        OrderDocument::find($id)->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }

    public function changeStatus(Request $request)
    {
        $id = $request->order_id;
        $status = Order::find($id)->status;

        OrderHistory::create([
            'order_id' => $id,
            'status'   => $request->status,
            'comment'  => "Order status has been changed to ".$request->status,
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        $order = Order::find($id);

        if (!in_array($order->status, ['completed', 'delivered']) && in_array($request->status, ['completed', 'delivered'])) {
            Product::find($order->product_id)->increment('sold_quantity', $order->quantity);
            Product::find($order->product_id)->decrement('available_quantity', $order->quantity);
        }

        if (!in_array($order->status, ['cancelled']) && in_array($request->status, ['cancelled'])) {
            Product::find($order->product_id)->increment('available_quantity', $order->quantity);
            Product::find($order->product_id)->decrement('sold_quantity', $order->quantity);
        }

        Order::find($id)->update([
            'status' => $request->status,
        ]);

        if($request->status == 'cancelled'){
            $order = Order::find($id);

            $user = Franchise::find($order->franchise_id);

            $product_url = route('admin.products.show', $order->product_id);
            $order_url = route('admin.orders.show', $order->id);

            $user->wallet->deposit($order->total, [
                'description' => 'Return for Purchase of Product Id <a href="'.$product_url.'"> #'.$order->product_id.'</a> 
                Order Id <a href="'.$order_url.'">#'.$order->id.'</a>'
            ]);

        }

        $order = Order::find($id);

        //Order Status Notification

        $franchise_id = $order->franchise_id;

        $franchise = Franchise::find($franchise_id);

        $franchise->notify(new OrderStatusNotification($order, route('franchise.orders.show', $order->id)));

        if ($order->status == 'completed' || $order->status == 'delivered') {

            foreach ($franchise->chefs as $key => $chef) {
                $chef = Chef::find($chef->id);
                $chef->notify(new OrderStatusNotification($order, route('chef.orders.show', $order->id)));
            }
        }

        session()->flash('success', 'Order status changed successfully!');

        return response()->json(['success' => 'Order status changed successfully!'], 200);
    }


}
