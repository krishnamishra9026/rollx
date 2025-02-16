<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::whereNull('category_id')->orderBy('id', 'desc')->get();
        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('category_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'           => ['required'],
            'category_id'    => $request->type == 'main-category' ? [''] : ['required'],
            'category'       => ['required', 'unique:categories'],
            'status'         => ['required'],
        ]);

        $category                = new Category();
        $category->type          = $request->type;
        $category->category_id   = $request->category_id;
        $category->category      = $request->category;
        $category->status        = $request->status;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        switch ($category->type) {
            case 'category':
                $categories = Category::where('type', 'main-category')->get(['id', 'category']);
                break;
            case 'sub-category':
                $categories = Category::where('type', 'category')->get(['id', 'category']);
                break;            
            default:
                $categories = [];
                break;
        }      
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'type'           => ['required'],
            'category_id'    => $request->type == 'main-category' ? [''] : ['required'],
            'category'       => ['required', 'unique:categories,category,' . $id],
            'status'         => ['required'],
        ]);

        $category                = Category::find($id);
        $category->type          = $request->type;
        $category->category_id   = $request->category_id;
        $category->category      = $request->category;
        $category->status        = $request->status;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function getPartsByCategory(Request $request)
    {
        $parts      = Part::where('category_id', $request->category_id)->get();

        $output         = '';
        $output        .= '<option value="">Choose Part</option>';
        foreach ($parts as $part) {
            $output    .= '<option value="' . $part->id . '">' . $part->part . '</option>';
        }

        return response()->json(['parts' => $output], 200);
    }

    public function getSubcategories(Request $request)
    {
        switch ($request->type) {
            case 'category':
                $categories = Category::where('type', 'main-category')->get(['id', 'category']);
                break;
            case 'sub-category':
                $categories = Category::where('type', 'category')->get(['id', 'category']);
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
}
