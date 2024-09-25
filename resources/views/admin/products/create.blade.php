@extends('layouts.admin')

@section('content')
    <h1>Create Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" class="form-control" placeholder="Enter SKU" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" placeholder="Enter price" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter product description" required></textarea>
        </div>

        <div class="form-group">
            <label for="categories">Categories</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category }}" id="category{{ $loop->index }}">
                    <label class="form-check-label" for="category{{ $loop->index }}">
                        {{ $category }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="images">Select Images</label>
            <button type="button" id="select-images-btn" class="btn btn-primary">Select Images</button>
            <div id="selected-images"></div>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
            <small class="form-text text-muted">You can select up to 5 images.</small>
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const maxImages = 5;
        const selectImagesBtn = document.getElementById('select-images-btn');
        const selectedImagesContainer = document.getElementById('selected-images');
        let selectedImages = [];

        selectImagesBtn.addEventListener('click', function() {
            fetch('{{ route('admin.products.images') }}')
                .then(response => response.json())
                .then(images => {
                    let popupHtml = `<div class="image-popup">`;
                    images.forEach(image => {
                        popupHtml += `
                            <div>
                                <input type="checkbox" class="image-checkbox" value="${image}" 
                                       ${selectedImages.includes(image) ? 'checked' : ''}>
                                <img src="{{ asset('storage/${image}') }}" alt="${image}" style="width: 100px; height: auto;">
                            </div>`;
                    });
                    popupHtml += `<button id="save-images-btn">Save Selection</button></div>`;
                    document.body.insertAdjacentHTML('beforeend', popupHtml);

                    document.getElementById('save-images-btn').addEventListener('click', function() {
                        const checkboxes = document.querySelectorAll('.image-checkbox:checked');
                        selectedImages = Array.from(checkboxes).map(cb => cb.value);
                        selectedImagesContainer.innerHTML = selectedImages.map(image => `<img src="{{ asset('storage/${image}') }}" style="width: 100px; height: auto;">`).join('');
                        document.querySelector('.image-popup').remove();
                    });
                });
        });
    });
</script>
@endpush
