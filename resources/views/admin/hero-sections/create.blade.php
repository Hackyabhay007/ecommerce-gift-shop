@extends('layouts.admin')

@section('content')
    <h1>Create Hero Section</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero-sections.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" name="heading" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="subheading">Subheading</label>
            <textarea name="subheading" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="button_text">Button Text</label>
            <input type="text" name="button_text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="button_link">Button Link</label>
            <input type="text" name="button_link" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" name="image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="bg_color">Background Color (Hex)</label>
            <input type="text" name="bg_color" class="form-control" required pattern="^#[0-9A-Fa-f]{6}$">
        </div>

        <button type="submit" class="btn btn-success">Create Hero Section</button>
    </form>
@endsection