@extends('layouts.admin')

@section('content')
    <h1>Create Blog</h1>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter blog title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="categories">Categories (comma-separated)</label>
            <input type="text" name="categories" class="form-control" placeholder="Enter categories, separated by commas" value="{{ old('categories') }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author name" value="{{ old('author') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="10" placeholder="Enter blog content" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Blog Image (optional)</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Create Blog</button>
    </form>
@endsection
