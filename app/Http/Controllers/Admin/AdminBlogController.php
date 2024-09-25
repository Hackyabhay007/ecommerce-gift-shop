<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    // List all blogs
    public function index()
    {
        $blogs = Blog::all(); // Fetch all blogs
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show form to create a new blog
    public function create()
    {
        return view('admin.blogs.create'); // No need for BlogCategory
    }

    // Store new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required|string', // Categories as a comma-separated string
            'author' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('blogs', 'public') : null;

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'categories' => $request->categories ?? 'Uncategorized', // Provide a default value
            'image' => $imagePath
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    // Show single blog
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    // Edit blog
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog')); // No need for BlogCategory
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required|string', // Categories as a comma-separated string
            'author' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->update(['image' => $imagePath]);
        }

        $blog->update($request->except('image'));

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
