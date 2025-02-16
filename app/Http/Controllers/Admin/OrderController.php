<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentPart;
use App\Models\InventoryEquipment;
use App\Models\InventoryEquipmentPart;
use App\Models\InventoryEquipmentSerialNo;
use App\Models\Order;
use App\Models\OrderDocument;
use App\Models\OrderHistory;
use App\Models\OrderImage;
use App\Models\OrderPart;
use App\Models\Part;
use App\Models\PartSerialNo;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Franchise;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kutia\Larafirebase\Facades\Larafirebase;

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

        $orders              = Order::query();
        $orders              = isset($filter['date']) ? $orders->where('date', $filter['date']) : $orders;
        $orders              = isset($filter['status']) ? $orders->where('status', 'LIKE', '%' . $filter['status'] . '%') : $orders;

        $orders              = $orders->orderBy('id', 'desc')->paginate(20);
        
        return view('admin.orders.list', compact('orders', 'filter'));
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

    public function createPart(Request $request,$id)
    {
        $order              = Order::find($id);
        $categories         = Category::whereType('main-category')->get();
         return view('admin.orders.edit.add-parts',compact('id','categories','order'));
    }

    public function getSubcategories(Request $request)
    {
        switch ($request->type) {
            case 'category':
                $categories = Category::where('type', 'category')->where("category_id", $request->id)->get(['id', 'category']);
                break;
            case 'sub-category':
                $categories = Category::where('type', 'sub-category')->where("category_id", $request->id)->get(['id', 'category']);
                break;
            default:
                $categories = [];
                break;
        }

        $response = array();
        foreach ($categories as $category) {
            $response[] = array(
                "id" => $category->id,
                "text" => $category->category
            );
        }
        return response()->json($response);
    }

    public function addPart(Request $request){
    try {
                $quantity = Part::find($request->part_id)->quantity;

                $order_part = OrderPart::create([
                    'order_id'                  => $request->order_id,
                    'part_id'                   => $request->part_id,
                    'quantity'                  => $request->quantity,
                    // 'installation_date'         => $request->part_installation_date,
                    // 'warranty_upto'             => $request->part_warranty_upto,
                    // 'warranty_date'             => $request->warranty_date,
                    'available'                 => $request->quantity < $quantity ? true : false
                ]);

                $order              = Order::find($request->order_id);

                if($order->equipment_assemble_type == 'inventory'){
                    Part::where('id', $request->part_id)->decrement('quantity', $request->quantity);
                }

                $html = view('admin.orders.edit.parts-row', compact('order'))->render();
                $serial_nos = PartSerialNo::where("part_id", $request->part_id)->where("deducted", false)->where("replaced", false)->take($request->quantity)->get();

                foreach($serial_nos as $serial_no){
                    $serial_no->update([
                        'order_id' => $request->order_id,
                        'deducted' => true
                    ]);
                }

                return response()->json(['html' => $html], 200);
        }
        catch(\Exception $e) {
              dd($e);
            return false;
        }
    }

    public function addHistory(Request $request, $id){

        $status = Order::find($id)->status;

        OrderHistory::create([
            'order_id' => $id,
            'status'   => $request->status,
            'comment'  => $request->comment,
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        Order::find($id)->update([
            'status' => $request->status,
        ]);

        if($request->status == 'cancelled'){
            $order = Order::find($id);

            $user = Franchise::find($order->franchise_id);

            $user->wallet->deposit($order->total, ['description' => 'Return for Purchase of Product Id #'.$order->product_id.' Order Id #'.$order->id]);

        }

        return redirect()->back()->with('success', 'Order History added successfully');
    }

    public function generatePurchaseOrder(Request $request, $id){

        $order = Order::find($id)->update(['status' => 'PO Generated']);

       $purchase_order =  PurchaseOrder::create([
            'order_id'      => $id,
            'supplier_id'   => 1,
            'status'        => 'PO Generated'
        ]);

        OrderHistory::create([
            'order_id' => $id,
            'status'   => 'PO Generated',
            'comment'  => 'Purchase Order for Order #'.$id.  ' has been generated!',
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        $suppliers = Supplier::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        Larafirebase::withTitle('New Puchase Order Generated')
        ->withBody('Purchase Order #'.$purchase_order->id. ' has been generated!')
        ->sendMessage($suppliers);
        $ord = Order::find($id)->equipment_name;
        $transdate = Carbon::now()->format('Y-m-d');
        $dat = str_replace("-", "",$transdate);
        $string = <<<XML
        <?xml version='1.0'?>
        <table name="Transaction">
            <transaction>
                <transdate>$dat</transdate>
                <duedate>$dat</duedate>
                <type>POI</type>
                <namecode>1234</namecode>
                <gross>0.00</gross>
                <tofrom>GridPlus</tofrom>
                <paymentmethod>2</paymentmethod>
                <prodpricecode>A</prodpricecode>
                <mailingaddress>Grid Plus&#13;F-102&#13;C-6&#13;Sector 7&#13;Noida&#13;UP</mailingaddress>
                <deliveryaddress>Acme SG01 Ltd&#13;F-102&#13;C-6&#13;Sector 7&#13;Noida&#13;UP</deliveryaddress>
                <subfile name="Detail">
                    <detail>
                        <detail.account>7240-</detail.account>
                        <detail.taxcode>G</detail.taxcode>
                        <detail.gross>0.00</detail.gross>
                        <detail.tax>0.00</detail.tax>
                        <detail.net>0.00</detail.net>
                        <detail.description>$ord</detail.description>
                        <detail.stockqty>100.000000</detail.stockqty>
                        <detail.stockcode>CC100</detail.stockcode>
                        <detail.costprice>0.00</detail.costprice>
                        <detail.unitprice>0.00</detail.unitprice>
                        <detail.saleunit>ea</detail.saleunit>
                        <detail.orderqty>1.000000</detail.orderqty>
                    </detail>
                </subfile>
            </transaction>
        </table>
        XML;

        // $xml = simplexml_load_string($string);

        // print_r($xml);

        // die();

        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://sg01.moneyworks.net.nz:6710/REST/COG%2fDemo%2fAcme%20Widgets%20SGREST.moneyworks/import?table=product&format=xml");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
        // set Auth headers for Datacentre login, and document login
        $headers = array(
            "Authorization: Basic " . base64_encode("COG/Demo:Datacentre:4S03M6BNCN05SWL~LU2F"),
            "Authorization: Basic " . base64_encode("Nurul Hasan:Document:Z~E07_PZP3SKV8")
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        header("Content-Type: text/xml");

        return redirect()->route('admin.purchase-orders.index')->with('success', 'PO Generated successfully on Admin and Moneyworks');
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
        $status = Order::find($request->order_id)->status;

        if($status == 'completed' && $request->status != 'completed'){
            Order::find($request->order_id)->update([
                'status' => $request->status,
            ]);
            Equipment::where('order_id', $request->order_id)->delete();
        }

        OrderHistory::create([
            'order_id' => $request->order_id,
            'status'   => $request->status,
            'comment'  => "Order status has been changed to ".$request->status,
            'status_changed_by' => 'administrator',
            'status_changer_id' => Auth::user()->id
        ]);

        Order::find($request->order_id)->update([
            'status' => $request->status,
        ]);

        if($request->status == 'completed'){



            $order = Order::find($request->order_id);

            $equipment = Equipment::create([
                'supplier_id'               => 1,
                'user_id'                   => $order->user_id,
                'order_id'                  => $order->id,
                'user_address_id'           => $order->user_address_id,
                'equipment_assemble_type'   => $order->equipment_assemble_type,
                'equipment_name'            => $order->equipment_name,
                'installation_date'         => $order->installation_date,
                'warranty_upto'             => $order->warranty_upto,
                'warranty_date'             => $order->warranty_date,
                'service_contract'          => $order->service_contract,
                'service_start_date'        => $order->service_start_date,
                'service_interval'          => $order->service_interval,
                'status'                    => 1,
                'serial_number'             => $order->serial_number,
                'quotation_reference'       => $order->quotation_reference,
                'remarks'                   => $order->remarks,
            ]);

            PartSerialNo::where("order_id", $order->id)->where("deducted", true)->where("replaced", false)->update(['equipment_id' => $equipment->id, "deducted" => true]);

            foreach($order->parts as $part){
                $order_part = EquipmentPart::create([
                    'equipment_id'              => $equipment->id,
                    'part_id'                   => $part->part_id,
                    'quantity'                  => $part->quantity,
                    'installation_date'         => $part->part_installation_date,
                    'warranty_upto'             => $part->part_warranty_upto,
                    'replace'                   => false
                ]);
            }
        }

        if($request->status == 'cancelled'){
            $order = Order::find($request->order_id);
            if($order->equipment_assemble_type == "inventory"){
                InventoryEquipmentSerialNo::where("serial_no", $order->serial_number)->update(['deducted' => false]);
            }
        }
        return response()->json(['success' => 'Order status changed successfully!'], 200);
    }


}
