@extends('layouts.admin')

@section('content')
    <h1>Edit Hero Section</h1>
    <form action="{{ route('admin.hero-sections.update', $heroSection->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" name="heading" id="heading" class="form-control" value="{{ $heroSection->heading }}" required>
        </div>
        <div class="form-group">
            <label for="subheading">Subheading</label>
            <textarea name="subheading" id="subheading" class="form-control" required>{{ $heroSection->subheading }}</textarea>
        </div>
        <div class="form-group">
            <label for="button_text">Button Text</label>
            <input type="text" name="button_text" id="button_text" class="form-control" value="{{ $heroSection->button_text }}" required>
        </div>
        <div class="form-group">
            <label for="button_link">Button Link</label>
            <input type="text" name="button_link" id="button_link" class="form-control" value="{{ $heroSection->button_link }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ $heroSection->image }}" required>
        </div>
        <div class="form-group">
            <label for="bg_color">Background Color (Hex)</label>
            <input type="text" name="bg_color" id="bg_color" class="form-control" value="{{ $heroSection->bg_color }}" required pattern="^#[0-9A-Fa-f]{6}$">
        </div>
        <button type="submit" class="btn btn-primary">Update Hero Section</button>
    </form>
@endsection