<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all blogs
    public function index()
    {
        return Blog::all();
    }

    // Store a new blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
        ]);

        $blog = Blog::create($validated);
        return response()->json($blog, 201);
    }

    // Show a blog by ID
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

    // Update a blog
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->all());
        return response()->json($blog);
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(null, 204);
    }
}
