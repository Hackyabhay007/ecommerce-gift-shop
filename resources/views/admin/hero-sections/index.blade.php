@extends('layouts.admin')

@section('content')
    <h1>Hero Sections</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.hero-sections.create') }}" class="btn btn-primary mb-3">Create New Hero Section</a>

    <table class="table">
        <thead>
            <tr>
                <th>Heading</th>
                <th>Subheading</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($heroSections as $heroSection)
                <tr>
                    <td>{{ $heroSection->heading }}</td>
                    <td>{{ $heroSection->subheading }}</td>
                    <td>
                        <a href="{{ route('admin.hero-sections.edit', $heroSection->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.hero-sections.destroy', $heroSection->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection