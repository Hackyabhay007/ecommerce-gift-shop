<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display the list of products
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'categories' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }

        $validated['images'] = json_encode($images);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // Show form to edit an existing product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'categories' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
            $validated['images'] = json_encode($images);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }
}
