@extends('layouts.admin')

@section('content')
    <h1>{{ $blog->title }}</h1>

    <p><strong>Categories:</strong> {{ $blog->categories }}</p>
    <p><strong>Author:</strong> {{ $blog->author }}</p>
    <p><strong>Content:</strong></p>
    <p>{{ $blog->content }}</p>

    @if($blog->image)
        <div>
            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" style="width: 200px;">
        </div>
    @endif

    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
