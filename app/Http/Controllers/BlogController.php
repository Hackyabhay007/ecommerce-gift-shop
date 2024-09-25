<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all blogs with pagination
    public function index()
    {
        return Blog::with('category')->paginate(10); // 10 blogs per page
    }

    // Show single blog by ID
    public function show(Blog $blog)
    {
        return response()->json($blog->load('category'));
    }
}
