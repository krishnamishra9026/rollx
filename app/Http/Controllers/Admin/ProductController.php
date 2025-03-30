<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDocument;
use App\Models\ProductImage;
use App\Models\ProductQuantityLog;
use Illuminate\Support\Facades\DB;

use App\Exports\Admin\ProductsExport;
use App\Imports\Admin\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ProductController extends Controller
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
        $filter['product']             = $request->product;
        $filter['outlet_name']    = $request->outlet_name;

        $products              = Product::query();
        $products              = isset($filter['product']) ? $products->where('id', $filter['product'] ) : $products;
        $products              = isset($filter['outlet_name']) ? $products->where('outlet_name', 'LIKE', '%' . $filter['outlet_name'] . '%') : $products;

        $products              = $products->orderBy('id', 'desc')->paginate(20);
        $product_data          = Product::all();

        return view('admin.products.list', compact('products', 'filter', 'product_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $nextId = $statement[0]->Auto_increment;
        return view('admin.products.create', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function productQuantity(Request $request)
    {
        $filter                     = [];
        $filter['product']             = $request->product;
        $filter['date']             = $request->date;

        $products = Product::query();

        if (isset($filter['product'])) {
            $products = $products->where('id', $filter['product']);
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(20);              

        $product_list = Product::latest()->get();   

        $query = ProductQuantityLog::orderBy('date_added', 'desc');

        if ($request->has('product') && !empty($request->product)) {
            $query->where('product_id', $request->product);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('date_added', $request->date);
        }

        $logs = $query->where('type', 'add')->paginate(20);    


        $query_log = ProductQuantityLog::orderBy('date_added', 'desc');

        if ($request->has('product') && !empty($request->product)) {
            $query_log->where('product_id', $request->product);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query_log->whereDate('date_added', $request->date);
        }
        $deducted_logs = $query_log->where('type', 'deduct')->paginate(20);                  

        return view('admin.products.quantity.list', compact('products', 'product_list', 'logs', 'filter', 'deducted_logs'));
    }

    public function store(Request $request)
    {              

        $this->validate($request, [
            'name'      => ['required', 'unique:products'],
            'quantity'          => ['required'],

        ]);

        $part                = new Product();
        $part->name          = $request->name;
        $part->outlet_name   = $request->outlet_name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->sold_color  = $request->sold_color;
        $part->quantity      = $request->quantity;
        $part->available_quantity  = $request->quantity;
        $part->sold_quantity = 0;
        $part->refrence      = $request->refrence;
        $part->selling_type  = $request->selling_type;
        $part->status        = $request->status;
        $part->save();

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name      = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/products/'.$part->id.'/images', $image_name, 'public');
               ProductImage::create([
                   'product_id'    => $part->id,
                   'name'       => $image_name
               ]);
           }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');

    }

    /**
     * Display the specified resource.
     */

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully!');
    }

    public function downloadSampleCsv(): BinaryFileResponse
    {
        $filePath = storage_path('sample_products.csv');

        if (!file_exists($filePath)) {
            $sampleData = "name,outlet_name,quantity,price\nSample Product,Outlet 1,10,50.00";
            file_put_contents($filePath, $sampleData);
        }

        return response()->download($filePath);
    }

    public function export(Request $request)
    {              
        $filters = $request->only(['status', 'order_date', 'product', 'order']);
        return Excel::download(new ProductsExport($filters), 'products.xlsx');
    }

    public function show(string $id)
    {
        $product       = Product::find($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product       = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $product = Product::find($request->id);
        $product->quantity = $request->quantity;
        $product->available_quantity = $request->quantity - $product->sold_quantity;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully!']);
    }

    public function changeStatus(Request $request, $id)
    {
        $product = Product::find($id);
        if($product->status == '1'){
            Product::find($id)->update(['status' => false]);
            return redirect()->route('admin.products.index')->with('warning', 'Product has been disabled successfully!');
        }else{
            Product::find($id)->update(['status' => true]);
            return redirect()->route('admin.products.index')->with('success', 'Product has been enabled successfully!');
        }
    }
    
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'              => ['required', 'unique:products,name,'.$id],
            'quantity'          => ['required'],
        ]);

        $part                       = Product::find($id);
        $part->name          = $request->name;
        $part->outlet_name   = $request->outlet_name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->sold_color  = $request->sold_color;
        $part->quantity      = $request->quantity;
        $part->selling_type  = $request->selling_type;
        $part->available_quantity  = $request->quantity - $part->sold_quantity;
        $part->sold_quantity = $part->sold_quantity;
        $part->refrence      = $request->refrence;
        $part->status        = $request->status ?? 1;
        $part->save();

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/products/'.$part->id.'/images', $image_name, 'public');
               ProductImage::create([
                   'product_id' => $part->id,
                   'name'     => $image_name
               ]);
           }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $issues = [];

        if ($product->orders()->exists()) {
            $issues[] = 'Product is linked to orders.';
        }
        if ($product->sales()->exists()) {
            $issues[] = 'Product has sales records.';
        }
        if ($product->productPrices()->exists()) {
            $issues[] = 'Product has franchise price records.';
        }
        if ($product->plate_setting()->exists()) {
            $issues[] = 'Product is assigned to a franchise plate setting.';
        }              

        if (!empty($issues)) {
            $product->update(['status' => 0]); 
            return back()->with('errors', $issues);
        }

        Product::find($id)->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function deleteImage(Request $request, $id){
        ProductImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteDocument(Request $request, $id){
        ProductDocument::find($id)->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }
}
