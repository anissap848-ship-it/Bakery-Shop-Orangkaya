<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">Add New Product</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: #6B4423; color: white;">
                        <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Product Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="e.g., Butter Croissant"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter a descriptive name for your product</small>
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
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Include ingredients, taste, and special features</small>
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
                                    <option value="Artisan Breads" {{ old('category') == 'Artisan Breads' ? 'selected' : '' }}>
                                        🍞 Artisan Breads
                                    </option>
                                    <option value="Sweet Pastries" {{ old('category') == 'Sweet Pastries' ? 'selected' : '' }}>
                                        🥐 Sweet Pastries
                                    </option>
                                    <option value="Custom Cakes" {{ old('category') == 'Custom Cakes' ? 'selected' : '' }}>
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
                                               value="{{ old('price') }}"
                                               step="0.01"
                                               min="0"
                                               placeholder="0.00"
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Price in US Dollars</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="stock" class="form-label fw-semibold">
                                        Stock Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input type="number"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           id="stock"
                                           name="stock"
                                           value="{{ old('stock', 0) }}"
                                           min="0"
                                           placeholder="0"
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Available units</small>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">
                                    Product Image
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
                                <small class="text-muted">Accepted: JPG, PNG, GIF (Max: 2MB)</small>

                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <p class="fw-semibold mb-2">Preview:</p>
                                    <img id="preview" src="" alt="Preview" style="max-width: 300px; border-radius: 10px; border: 2px solid #e9ecef;">
                                </div>
                            </div>

                            <!-- Alert Info -->
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle me-2"></i>
                                <div>
                                    <strong>Note:</strong> All fields marked with <span class="text-danger">*</span> are required.
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="bi bi-save"></i> Save Product
                                </button>
                            </div>
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
