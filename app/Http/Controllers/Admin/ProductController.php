<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDocument;
use App\Models\ProductImage;
use App\Models\ProductSerialNo;
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
        $filter['name']             = $request->name;
        $filter['model_number']     = $request->model_number;
        $filter['serial_number']    = $request->serial_number;
        $filter['parent_category']  = $request->parent_category;

        $products              = Product::query();
        $products              = isset($filter['name']) ? $products->where('name', 'LIKE', '%' . $filter['name'] . '%') : $products;
        $products              = isset($filter['model_number']) ? $products->where('model_number', 'LIKE', '%' . $filter['model_number'] . '%') : $products;
        $products              = isset($filter['serial_number']) ? $products->where('serial_number', 'LIKE', '%' . $filter['serial_number'] . '%') : $products;

        $products              = $products->orderBy('id', 'desc')->paginate(20);

        return view('admin.products.list', compact('products', 'filter'));
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
    public function store(Request $request)
    {              

        $this->validate($request, [
            'name'          => ['required'],
            'model_number'      => ['required', 'unique:products'],
            'quantity'          => ['required'],
            'status'            => ['required'],

        ]);

        $part                = new Product();
        $part->name          = $request->name;
        $part->outlet_name   = $request->outlet_name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->sold_color  = $request->sold_color;
        $part->serial_number = $request->serial_number;
        $part->quantity      = $request->quantity;
        $part->available_quantity  = $request->quantity;
        $part->sold_quantity = 0;
        $part->refrence      = $request->refrence;
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
            $sampleData = "name,outlet_name,quantity,price,model_number\nSample Product,Outlet 1,10,50.00,MOD123";
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
        $product->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully!']);
    }
    
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'              => ['required'],
            'model_number'      => ['required', 'unique:products,model_number,' . $id],
            'quantity'          => ['required'],
            'status'            => ['required'],
        ]);

        $part                       = Product::find($id);
        $part->name          = $request->name;
        $part->outlet_name   = $request->outlet_name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->serial_number = $request->serial_number;
        $part->sold_color  = $request->sold_color;
        $part->quantity      = $request->quantity;
        $part->available_quantity  = $request->quantity;
        $part->sold_quantity = 0;
        $part->refrence      = $request->refrence;
        $part->status        = $request->status;
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
