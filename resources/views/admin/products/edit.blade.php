@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="categories">Categories</label>
            <input type="text" name="categories" value="{{ implode(',', $product->categories) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="images">Product Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <div class="form-group">
            
    <label>Current Images</label>
    <div class="row">
        @if($product->images)
            @foreach(json_decode($product->images) as $image)
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endforeach
        @endif
    </div>
</div>

    </form>
</div>
@endsection
