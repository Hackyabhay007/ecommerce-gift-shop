<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'stock_quantity' => 'required|integer',
        'size' => 'nullable|string|max:255',
        'weight' => 'nullable|numeric',
        'images' => 'required|array|min:3|max:5',  // Minimum 3 images, maximum 5 images
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Generate SKU
    $sku = strtoupper(uniqid('SKU-'));

    // Handle image uploads
    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            $imagePaths[] = $path;
        }
    }

    // Create the product
    $product = Product::create([
        'product_id' => uniqid(),
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'categories' => $request->categories,
        'sku' => $sku,  // Set generated SKU
        'stock_quantity' => $request->stock_quantity,
        'size' => $request->size,
        'weight' => $request->weight,
        'images' => $imagePaths,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
}

    // Show the form for editing the specified product
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
            'categories' => 'sometimes|required|array',
            'categories.*' => 'exists:categories,id',
            'stock_quantity' => 'sometimes|required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePaths = $product->images; // Keep existing images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'categories' => $request->categories,
            'stock_quantity' => $request->stock_quantity,
            'size' => $request->size,
            'weight' => $request->weight,
            'images' => $imagePaths,
        ]);
    
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }
    

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
