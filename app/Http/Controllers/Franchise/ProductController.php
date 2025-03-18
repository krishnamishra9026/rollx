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
        $filter                = [];
        $filter['product']     = $request->product;

        $products = Product::where('available_quantity', '>', 0)->where('status', 1)
            ->whereHas('franchises', function ($query) {
                    $query->where('franchise_id', auth()->user()->id);
            });

        if (isset($filter['product'])) {
            $products->where('id', $filter['product']);
        }

        $products = $products->orderBy('id', 'desc')->paginate(20);

        if ($products->count() <= 0) 
        {
            $products              = Product::where('available_quantity', '>', 0)->where('status', 1);
            $products              = isset($filter['product']) ? $products->where('id', $filter['product'] ) : $products;
            $products              = $products->orderBy('id', 'desc')->paginate(20);
        }

        $product_data          = Product::all();

        return view('franchise.products.list', compact('products', 'filter', 'product_data'));
    }

    public function stocks(Request $request)
    {
        $filter                        = [];
        $filter['product']             = $request->product;

        $stocks = Product::where('available_quantity', '>', 0)
            ->whereHas('franchises', function ($query) {
                    $query->where('franchise_id', auth()->user()->id);
            });

        if (isset($filter['product'])) {
            $stocks->where('id', $filter['product']);
        }

        $stocks = $stocks->orderBy('id', 'desc')->paginate(20);

        if ($stocks->count() <= 0) 
        {
            $stocks              = Product::where('available_quantity', '>', 0)->where('status', 1);
            $stocks              = isset($filter['product']) ? $stocks->where('id', $filter['product'] ) : $stocks;
            $stocks              = $stocks->orderBy('id', 'desc')->paginate(20);
        }

        $product_data          = Product::all();

        return view('franchise.stocks.list', compact('stocks', 'filter', 'product_data'));
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
