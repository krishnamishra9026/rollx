<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinymceController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/tinymce', $filename, 'public');

            return response()->json(['location' => asset('storage/' . $path)]);
        }
    }
}
