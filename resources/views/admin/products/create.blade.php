@extends('layouts.admin')

@section('content')
    <h1>Create Product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="sku" placeholder="SKU" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="stock_quantity" placeholder="Stock Quantity" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
