<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all blogs with pagination
    public function index($start, $end)
    {
        $perPage = $end - $start + 1; // Calculate the number of blogs per page based on the start and end values
        
        // Fetch blogs with pagination, offsetting by the start value
        $blogs = Blog::skip($start - 1)->take($perPage)->get();

        $totalBlogs = Blog::count(); // Get the total number of blogs

        // Customize the pagination response
        $response = [
            'current_page' => ceil($start / $perPage), // Calculate current page based on start
            'data' => $blogs,
            'total_blogs' => $totalBlogs,
            'per_page' => $perPage,
            'from' => $start,
            'to' => $end,
            'first_page_url' => url('/blog/blogs-1-' . $perPage),
            'last_page_url' => url('/blog/blogs-' . (floor($totalBlogs / $perPage) * $perPage + 1) . '-' . $totalBlogs),
            'next_page_url' => $end < $totalBlogs ? url('/blog/blogs-' . ($end + 1) . '-' . ($end + $perPage)) : null,
            'prev_page_url' => $start > 1 ? url('/blog/blogs-' . max(1, $start - $perPage) . '-' . ($start - 1)) : null
        ];

        return response()->json($response);
    }

    // Show a single blog by ID
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }
}
