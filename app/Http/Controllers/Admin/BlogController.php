<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $blogs = Blog::latest()->paginate(20);
        return view('admin.blogs.list', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {              
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable',
            'content' => 'required'
        ]);

        $data = $request->all();

        $data['admin_id'] = auth()->user()->id;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name      = time().rand(1,50).'.'.$file->extension();
            $file->storeAs('uploads/blogs', $image_name, 'public');
            $data['header_image'] = $image_name;
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'heading' => 'nullable',
            'content' => 'required'
        ]);

        $data = $request->all();

        $data['admin_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name      = time().rand(1,50).'.'.$file->extension();
            $file->storeAs('uploads/blogs', $image_name, 'public');
            $data['header_image'] = $image_name;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
         if ($blog->header_image && file_exists(public_path($blog->header_image))) {
            unlink(public_path($blog->header_image));
        }

        // Delete the blog from the database
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
