<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return Product::all();
    }

    // Store a new product
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
    ]);

    Product::create([
        'product_id' => uniqid(), // Generate a unique product ID if needed
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

    return redirect()->route('admin.products.index');
}


    // Show a product by ID
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
