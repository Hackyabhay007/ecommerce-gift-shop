@extends('layouts.admin')

@section('content')
    <h1>Create Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" class="form-control" placeholder="Enter SKU" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
        </div>

        <div class="form-group">
            <label for="categories">Categories (as JSON array)</label>
            <input type="text" name="categories" class="form-control" placeholder='["category1", "category2"]' required>
        </div>

        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" placeholder="Enter size (optional)">
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" step="0.01" placeholder="Enter weight (optional)">
        </div>

        <div class="form-group">
            <label for="images">Images (as JSON array)</label>
            <input type="text" name="images" class="form-control" placeholder='["image1.png", "image2.png"]'>
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
@endsection
