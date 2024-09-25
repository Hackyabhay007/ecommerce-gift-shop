@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
@endsection