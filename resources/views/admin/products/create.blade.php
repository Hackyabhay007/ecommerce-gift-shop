@extends('layouts.admin')

@section('content')
    <h1>Create Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Product Name -->
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
        </div>

        <!-- Stock Quantity -->
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
        </div>

        <!-- Categories -->
        <div class="form-group">
            <label>Categories</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                    <label class="form-check-label" for="category{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Size -->
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" placeholder="Enter size (optional)">
        </div>

        <!-- Weight -->
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" step="0.01" placeholder="Enter weight (optional)">
        </div>

        <!-- Image Upload Fields -->
        <div class="form-group">
            <label for="images">Upload Images</label>
            <div>
                <input type="file" name="images[]" class="form-control-file" required>
                <small class="form-text text-muted">Image 1 (Mandatory)</small>
            </div>
            <div>
                <input type="file" name="images[]" class="form-control-file" required>
                <small class="form-text text-muted">Image 2 (Mandatory)</small>
            </div>
            <div>
                <input type="file" name="images[]" class="form-control-file" required>
                <small class="form-text text-muted">Image 3 (Mandatory)</small>
            </div>
            <div>
                <input type="file" name="images[]" class="form-control-file">
                <small class="form-text text-muted">Image 4 (Optional)</small>
            </div>
            <div>
                <input type="file" name="images[]" class="form-control-file">
                <small class="form-text text-muted">Image 5 (Optional)</small>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
@endsection
