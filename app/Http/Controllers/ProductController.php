<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get paginated list of products
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10); // Default to 10 products per page
        $products = Product::paginate($perPage);

        // Modify the images to return full URLs
        $products->getCollection()->transform(function ($product) {
            $product->images = array_map(function ($image) {
                return asset('storage/' . $image); // Generate full URL for each image
            }, $product->images);
            return $product;
        });

        return response()->json($products);
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'stock_quantity' => 'required|integer',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a random SKU
        $sku = strtoupper(uniqid('SKU-'));

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
            'categories' => $request->categories,
            'sku' => $sku,
            'stock_quantity' => $request->stock_quantity,
            'size' => $request->size,
            'weight' => $request->weight,
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.products.index');
    }

    // Show a product by ID
    public function show($id)
    {
        $product = Product::where('product_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Modify the images to return full URLs
        $product->images = array_map(function ($image) {
            return asset('storage/' . $image); // Generate full URL for each image
        }, $product->images);

        return response()->json($product);
    }

    // Update a product
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
            'images.*' => 'string',
        ]);

        $product->update($request->all());

        return response()->json($product);
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    // Get products by category
    public function getProductsByCategory($category)
    {
        $products = Product::whereJsonContains('categories', $category)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for this category'], 404);
        }

        // Modify the images to return full URLs
        $products->transform(function ($product) {
            $product->images = array_map(function ($image) {
                return asset('storage/' . $image); // Generate full URL for each image
            }, $product->images);
            return $product;
        });

        return response()->json($products);
    }

    // Get product by ID
    public function getProductById($id)
    {
        $product = Product::where('product_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Modify the images to return full URLs
        $product->images = array_map(function ($image) {
            return asset('storage/' . $image); // Generate full URL for each image
        }, $product->images);

        return response()->json($product);
    }
}
