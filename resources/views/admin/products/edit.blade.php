@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>

        <!-- Stock Quantity -->
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
        </div>

        <!-- Categories -->
        <div class="form-group">
            <label>Categories</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}"
                        {{ in_array($category->id, $product->categories) ? 'checked' : '' }}>
                    <label class="form-check-label" for="category{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Size -->
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" value="{{ $product->size }}">
        </div>

        <!-- Weight -->
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" step="0.01" value="{{ $product->weight }}">
        </div>

        <!-- Image Uploads -->
        <div class="form-group">
            <label for="images">Product Images</label>

            <div id="image-preview" class="mb-3">
                <h5>Current Images</h5>
                <div class="row">
                    @foreach($product->images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $image) }}" alt="Product Image" style="width: 100px; height: auto;">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="images">Upload New Images</label>
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

        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
@endsection
