@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="categories">Categories (as JSON array)</label>
            <input type="text" name="categories" class="form-control" value="{{ json_encode($product->categories) }}" required>
        </div>

        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" value="{{ $product->size }}">
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" step="0.01" value="{{ $product->weight }}">
        </div>

        <div class="form-group">
            <label for="images">Images (as JSON array)</label>
            <input type="text" name="images" class="form-control" value="{{ json_encode($product->images) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
@endsection
