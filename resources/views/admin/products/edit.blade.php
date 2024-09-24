@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $product->name }}" required>
        <input type="text" name="sku" value="{{ $product->sku }}" required>
        <input type="number" name="price" value="{{ $product->price }}" required>
        <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
        <textarea name="description" required>{{ $product->description }}</textarea>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
