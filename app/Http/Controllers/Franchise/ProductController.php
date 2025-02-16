<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDocument;
use App\Models\ProductImage;
use App\Models\ProductSerialNo;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $filter['name']             = $request->name;
        $filter['model_number']     = $request->model_number;
        $filter['serial_number']    = $request->serial_number;
        $filter['parent_category']  = $request->parent_category;

        $products              = Product::where('quantity', '>', 0);
        $products              = isset($filter['name']) ? $products->where('name', 'LIKE', '%' . $filter['name'] . '%') : $products;
        $products              = isset($filter['model_number']) ? $products->where('model_number', 'LIKE', '%' . $filter['model_number'] . '%') : $products;
        $products              = isset($filter['serial_number']) ? $products->where('serial_number', 'LIKE', '%' . $filter['serial_number'] . '%') : $products;

        $products              = $products->orderBy('id', 'desc')->paginate(20);

        return view('franchise.products.list', compact('products', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
        $nextId = $statement[0]->Auto_increment;
        return view('franchise.products.create', compact('nextId'));
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
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->serial_number = $request->serial_number;
        $part->quantity      = $request->quantity;
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

        return redirect()->route('franchise.products.index')->with('success', 'Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product       = Product::find($id);
        return view('franchise.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product       = Product::find($id);
        return view('franchise.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
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
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->serial_number = $request->serial_number;
        $part->quantity      = $request->quantity;
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

        return redirect()->route('franchise.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('franchise.products.index')->with('success', 'Product deleted successfully');
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
