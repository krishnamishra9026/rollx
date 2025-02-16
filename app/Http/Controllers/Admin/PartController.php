<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use App\Models\PartDocument;
use App\Models\PartImage;
use App\Models\PartSerialNo;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
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
        $filter['category']         = $request->category;
        $filter['part']             = $request->part;
        $filter['model_number']     = $request->model_number;
        $filter['serial_number']    = $request->serial_number;
        $filter['parent_category']  = $request->parent_category;

        $parts              = Part::with('category');
        $parts              = isset($filter['category']) ? $parts->where('category_id', $filter['category']) : $parts;
        $parts              = isset($filter['part']) ? $parts->where('part', 'LIKE', '%' . $filter['part'] . '%') : $parts;
        $parts              = isset($filter['model_number']) ? $parts->where('model_number', 'LIKE', '%' . $filter['model_number'] . '%') : $parts;
        $parts              = isset($filter['serial_number']) ? $parts->where('serial_number', 'LIKE', '%' . $filter['serial_number'] . '%') : $parts;
        if(isset($filter['parent_category'])){
            $sub_categories =  Category::where('category_id', $filter['parent_category'])->whereType('sub-category')->pluck('id')->toArray();
            $parts = $parts->whereIn('category_id', $sub_categories);
        }

        $parts              = $parts->orderBy('id', 'desc')->paginate(20);

        $categories         = Category::whereType('category')->get();

        return view('admin.parts.list', compact('parts', 'categories', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereType('category')->get();
        $statement = DB::select("SHOW TABLE STATUS LIKE 'parts'");
        $nextId = $statement[0]->Auto_increment;
        return view('admin.parts.create', compact('categories','nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'category'          => ['required'],
            'part'              => ['required'],
            'model_number'      => ['required', 'unique:parts'],
            'quantity'          => ['required'],
            'min_stock_count'   => ['required'],
            'status'            => ['required'],
            'remark'            => ['required'],

        ]);

        $part                = new Part();
        $part->category_id   = $request->category;
        $part->part          = $request->part;
        $part->model_number  = $request->model_number;
        $part->serial_number = null;
        $part->quantity      = $request->quantity;
        $part->refrence      = $request->refrence;
        $part->status        = $request->status;
        $part->remark        = $request->remark;
        $part->min_stock_count      = $request->min_stock_count;
        $part->save();

        if($request->hasfile('documents')){
           foreach($request->file('documents') as $file){
               $document_name   = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/parts/'.$part->id.'/documents', $document_name, 'public');
               PartDocument::create([
                   'part_id'    => $part->id,
                   'name'       => $document_name
               ]);
           }
        }

        for ($i=1; $i < $request->quantity + 1; $i++) {
            PartSerialNo::create([
                "part_id"       => $part->id,
                "serial_no"     => "SHL" . $part->id .'0000'.$i
            ]);
          }

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name      = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/parts/'.$part->id.'/images', $image_name, 'public');
               PartImage::create([
                   'part_id'    => $part->id,
                   'name'       => $image_name
               ]);
           }
        }

        return redirect()->route('admin.parts.index')->with('success', 'Part created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $part       = Part::find($id);
        $categories = Category::whereType('category')->get();
        return view('admin.parts.show', compact('categories', 'part'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $part       = Part::find($id);
        $categories = Category::whereType('category')->get();
        return view('admin.parts.edit', compact('categories', 'part'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'category'          => ['required'],
            'part'              => ['required'],
            'model_number'      => ['required', 'unique:parts,model_number,' . $id],
            'quantity'          => ['required'],
            'min_stock_count'   => ['required'],
            'status'            => ['required'],
            'remark'            => ['required'],
        ]);

        $part                       = Part::find($id);
        $part->category_id          = $request->category;
        $part->part                 = $request->part;
        $part->model_number         = $request->model_number;
        $part->serial_number        = null;
        $part->quantity             = $request->quantity;
        $part->refrence             = $request->refrence;
        $part->status               = $request->status;
        $part->remark               = $request->remark;
        $part->min_stock_count      = $request->min_stock_count;
        $part->notification         = ($request->quantity <= $request->min_stock_count)?1:0;
        $part->save();

        if($request->hasfile('documents'))
        {
           foreach($request->file('documents') as $file)
           {
               $document_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/parts/'.$part->id.'/documents', $document_name, 'public');
               PartDocument::create([
                   'part_id' => $part->id,
                   'name'     => $document_name
               ]);
           }
        }

        for ($i=1; $i < $request->quantity + 1; $i++) {
            PartSerialNo::create([
                "part_id" => $part->id,
                "serial_no" => "SHL" . $part->id .'0000'.$i
            ]);
          }

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/parts/'.$part->id.'/images', $image_name, 'public');
               PartImage::create([
                   'part_id' => $part->id,
                   'name'     => $image_name
               ]);
           }
        }


        return redirect()->route('admin.parts.index')->with('success', 'Part updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Part::find($id)->delete();
        return redirect()->route('admin.parts.index')->with('success', 'Part deleted successfully');
    }

    public function deleteImage(Request $request, $id){
        PartImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteDocument(Request $request, $id){
        PartDocument::find($id)->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }
}
