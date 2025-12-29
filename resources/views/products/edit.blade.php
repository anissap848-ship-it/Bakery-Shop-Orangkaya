<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">Edit Product</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: #8B5A3C; color: white;">
                        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Product Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="e.g., Butter Croissant"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description"
                                          name="description"
                                          rows="4"
                                          placeholder="Describe your product..."
                                          required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category" class="form-label fw-semibold">
                                    Category <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('category') is-invalid @enderror"
                                        id="category"
                                        name="category"
                                        required>
                                    <option value="">-- Select Category --</option>
                                    <option value="Artisan Breads"
                                            {{ old('category', $product->category) == 'Artisan Breads' ? 'selected' : '' }}>
                                        🍞 Artisan Breads
                                    </option>
                                    <option value="Sweet Pastries"
                                            {{ old('category', $product->category) == 'Sweet Pastries' ? 'selected' : '' }}>
                                        🥐 Sweet Pastries
                                    </option>
                                    <option value="Custom Cakes"
                                            {{ old('category', $product->category) == 'Custom Cakes' ? 'selected' : '' }}>
                                        🎂 Custom Cakes
                                    </option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price & Stock Row -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-semibold">
                                        Price (USD) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number"
                                               class="form-control @error('price') is-invalid @enderror"
                                               id="price"
                                               name="price"
                                               value="{{ old('price', $product->price) }}"
                                               step="0.01"
                                               min="0"
                                               placeholder="0.00"
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="stock" class="form-label fw-semibold">
                                        Stock Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input type="number"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           id="stock"
                                           name="stock"
                                           value="{{ old('stock', $product->stock) }}"
                                           min="0"
                                           placeholder="0"
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Current Image -->
                            @if($product->image)
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Current Image:</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             style="max-width: 300px; border-radius: 10px; border: 2px solid #e9ecef;">
                                    </div>
                                </div>
                            @endif

                            <!-- New Product Image -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">
                                    Change Product Image
                                </label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty to keep current image. Max: 2MB</small>

                                <!-- New Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <p class="fw-semibold mb-2">New Preview:</p>
                                    <img id="preview" src="" alt="Preview" style="max-width: 300px; border-radius: 10px; border: 2px solid #6B4423;">
                                </div>
                            </div>

                            <!-- Alert Warning -->
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <div>
                                    <strong>Warning:</strong> Changing the product image will replace the current one.
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="bi bi-save"></i> Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Section -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="bi bi-trash"></i> Danger Zone</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Once you delete this product, there is no going back. Please be certain.</p>
                        <form action="{{ route('products.destroy', $product) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewDiv.style.display = 'none';
            }
        }
    </script>

    <style>
        .btn-primary-custom {
            background-color: #6B4423;
            border: none;
            color: white;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: #8B5A3C;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .form-control:focus, .form-select:focus {
            border-color: #D4A574;
            box-shadow: 0 0 0 0.25rem rgba(212, 165, 116, 0.25);
        }

        .card {
            border-radius: 15px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</x-app-layout>
