@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="categories">Categories</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category }}" id="category{{ $loop->index }}"
                        {{ in_array($category, $product->categories ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="category{{ $loop->index }}">
                        {{ $category }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" value="{{ $product->size }}">
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control" step="0.01" value="{{ $product->weight }}">
        </div>

        <div class="form-group">
            <label for="images">Select Images</label>
            <button type="button" id="select-images-btn" class="btn btn-primary">Select Images</button>
            <div id="selected-images">
                @foreach($product->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image" style="width: 100px; height: auto; margin-right: 10px;">
                @endforeach
            </div>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
            <small class="form-text text-muted">You can select multiple images (up to 5).</small>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectImagesBtn = document.getElementById('select-images-btn');
        const selectedImagesContainer = document.getElementById('selected-images');
        const maxImages = 5;
        let selectedImages = @json($product->images);

        // Event listener for the "Select Images" button
        selectImagesBtn.addEventListener('click', function() {
            fetch('{{ route('admin.products.images') }}')
                .then(response => response.json())
                .then(images => {
                    let popupHtml = `<div class="image-popup" style="position:fixed; top:50px; left:50%; transform:translateX(-50%); background:white; padding:20px; z-index:1000; width:400px; height:300px; overflow:auto;">`;
                    images.forEach(image => {
                        popupHtml += `
                            <div>
                                <input type="checkbox" class="image-checkbox" value="${image}" 
                                       ${selectedImages.includes(image) ? 'checked' : ''}>
                                <img src="{{ asset('storage/${image}') }}" alt="${image}" style="width: 100px; height: auto;">
                            </div>`;
                    });
                    popupHtml += `<button id="save-images-btn" class="btn btn-primary mt-3">Save Selection</button></div>`;
                    document.body.insertAdjacentHTML('beforeend', popupHtml);

                    // Handle saving the selected images
                    document.getElementById('save-images-btn').addEventListener('click', function() {
                        const checkboxes = document.querySelectorAll('.image-checkbox:checked');
                        selectedImages = Array.from(checkboxes).map(cb => cb.value);
                        selectedImagesContainer.innerHTML = selectedImages.map(image => `<img src="{{ asset('storage/${image}') }}" style="width: 100px; height: auto; margin-right: 10px;">`).join('');
                        document.querySelector('.image-popup').remove();
                    });
                });
        });
    });
</script>
@endpush
