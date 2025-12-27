<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">Product Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning text-white">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid"
                                 style="width: 100%; height: 400px; object-fit: cover; border-radius: 15px;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                 style="height: 400px; border-radius: 15px;">
                                <div class="text-center">
                                    <i class="bi bi-image display-1 text-muted"></i>
                                    <p class="text-muted mt-3">No image available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header" style="background-color: #6B4423; color: white;">
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit Product
                            </a>
                            <button class="btn btn-outline-success" onclick="window.print()">
                                <i class="bi bi-printer"></i> Print Details
                            </button>
                            <form action="{{ route('products.destroy', $product) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-trash"></i> Delete Product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <!-- Category Badge -->
                        <span class="badge mb-3" style="background-color: #D4A574; font-size: 0.9rem; padding: 8px 15px;">
                            {{ $product->category }}
                        </span>

                        <!-- Product Name -->
                        <h1 class="h2 fw-bold mb-3" style="color: #6B4423;">
                            {{ $product->name }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-4">
                            <h3 class="h3 fw-bold" style="color: #6B4423;">
                                ${{ number_format($product->price, 2) }}
                            </h3>
                            <p class="text-muted mb-0">
                                Rp {{ number_format($product->price * 15000, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Stock Status -->
                        <div class="alert {{ $product->stock > 10 ? 'alert-success' : ($product->stock > 0 ? 'alert-warning' : 'alert-danger') }}" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-box-seam me-2 fs-5"></i>
                                <div>
                                    <strong>Stock Status:</strong>
                                    @if($product->stock > 10)
                                        In Stock ({{ $product->stock }} units available)
                                    @elseif($product->stock > 0)
                                        Low Stock (Only {{ $product->stock }} units left!)
                                    @else
                                        Out of Stock
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Description</h5>
                            <p class="text-muted" style="line-height: 1.8;">
                                {{ $product->description }}
                            </p>
                        </div>

                        <!-- Product Details Table -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Product Details</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold" style="width: 30%; background-color: #f8f9fa;">
                                            Product ID
                                        </td>
                                        <td>#{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" style="background-color: #f8f9fa;">Category</td>
                                        <td>{{ $product->category }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" style="background-color: #f8f9fa;">Price (USD)</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" style="background-color: #f8f9fa;">Stock</td>
                                        <td>
                                            <span class="badge {{ $product->stock > 10 ? 'bg-success' : 'bg-warning' }}">
                                                {{ $product->stock }} units
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" style="background-color: #f8f9fa;">Created At</td>
                                        <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" style="background-color: #f8f9fa;">Last Updated</td>
                                        <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Sales Info (Placeholder for future feature) -->
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Sales Information:</strong> Feature coming soon!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 15px;
        }

        @media print {
            .navbar, .btn, .alert-info {
                display: none !important;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</x-app-layout>
