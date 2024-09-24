<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Import the base Controller class

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
        return view('admin.products.create'); // Return the create product form view
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'categories' => 'required|string',
            'sku' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|string',
        ]);

        // Create new product
        $product = Product::create([
            'product_id' => uniqid(), // Optionally create a unique product ID
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'categories' => $request->categories,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'size' => $request->size,
            'weight' => $request->weight,
            'images' => $request->images,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    // Display the specified product by ID
    public function show(Product $product)
    {
        return response()->json($product); // Return JSON response of the product
    }

    // Show the form for editing a product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product')); // Pass product to the edit view
    }

    // Update the specified product in storage
    public function update(Request $request, Product $product)
    {
        // Validate input
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
            'categories' => 'sometimes|required|string',
            'sku' => 'sometimes|required|string|max:255',
            'stock_quantity' => 'sometimes|required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|string',
        ]);

        // Update the product
        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    // Remove the specified product from storage
    public function destroy(Product $product)
    {
        $product->delete(); // Delete the product

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
