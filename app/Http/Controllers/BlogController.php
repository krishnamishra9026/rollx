<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blogs.list', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'header_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable',
            'content' => 'required'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('header_image')) {
            $fileName = time() . '.' . $request->header_image->extension();
            $request->header_image->move(public_path('uploads'), $fileName);
            $data['header_image'] = 'uploads/' . $fileName;
        }

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
