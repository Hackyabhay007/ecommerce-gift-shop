<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck('name'); // Fetch category names
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'categories' => 'required|array',
            'sku' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }
    
        Product::create([
            'product_id' => uniqid(),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'categories' => $request->categories, // Storing category names as array
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'size' => $request->size,
            'weight' => $request->weight,
            'images' => $imagePaths,
        ]);
    
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck('name'); // Fetch category names
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
            'categories' => 'sometimes|required|array',
            'sku' => 'sometimes|required|string|max:255',
            'stock_quantity' => 'sometimes|required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function getUploadedImages()
    {
        $uploadedImages = Storage::disk('public')->files('products');
        return response()->json($uploadedImages);
    }
}
