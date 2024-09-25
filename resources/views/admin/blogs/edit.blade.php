@extends('layouts.admin')

@section('content')
    <h1>Edit Blog</h1>

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <div class="form-group">
            <label for="categories">Categories (comma-separated)</label>
            <input type="text" name="categories" class="form-control" value="{{ $blog->categories }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" value="{{ $blog->author }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="10" required>{{ $blog->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Blog Image (optional)</label>
            @if($blog->image)
                <div>
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 100px;">
                </div>
            @endif
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Update Blog</button>
    </form>
@endsection
