<x-app-layout>
    <x-slot name="header">
        <h2 class="h3 fw-bold mb-0" style="color: #6B4423;">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid px-4">
            <!-- Welcome Message -->
            <div class="alert alert-info border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #6B4423 0%, #8B5A3C 100%); color: white;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle fs-1 me-3"></i>
                    <div>
                        <h4 class="mb-1">Welcome back, {{ Auth::user()->name }}! </h4>
                        <p class="mb-0 opacity-75">Here's what's happening with your bakery today</p>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="stat-card stat-primary">
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="stat-details">
                            <p class="stat-label">Total Products</p>
                            <h2 class="stat-number">{{ $totalProducts }}</h2>
                        </div>
                        <div class="stat-badge">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="stat-card stat-info">
                        <div class="stat-icon">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <div class="stat-details">
                            <p class="stat-label">Total Units</p>
                            <h2 class="stat-number">{{ $totalUnits }}</h2>
                        </div>
                        <div class="stat-badge">
                            <i class="bi bi-stack"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="stat-card stat-success">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-details">
                            <p class="stat-label">In Stock</p>
                            <h2 class="stat-number">{{ $inStock }}</h2>
                        </div>
                        <div class="stat-badge">
                            <span class="badge bg-success">{{ $inStockPercentage }}%</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="stat-card stat-warning">
                        <div class="stat-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="stat-details">
                            <p class="stat-label">Low Stock</p>
                            <h2 class="stat-number">{{ $lowStock }}</h2>
                        </div>
                        <div class="stat-badge">
                            @if($lowStock > 0)
                                <span class="badge bg-warning">Action Needed</span>
                            @else
                                <span class="badge bg-secondary">All Good</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="stat-card stat-danger">
                        <div class="stat-icon">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="stat-details">
                            <p class="stat-label">Out of Stock</p>
                            <h2 class="stat-number">{{ $outOfStock }}</h2>
                        </div>
                        <div class="stat-badge">
                            @if($outOfStock > 0)
                                <span class="badge bg-danger">Critical</span>
                            @else
                                <span class="badge bg-success">Perfect!</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products by Category -->
            <div class="row">
                <!-- Artisan Breads -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm border-0 category-card">
                        <div class="card-header" style="background-color: #6B4423; color: white;">
                            <h5 class="mb-0">
                                <i class="bi bi-archive"></i> Artisan Breads
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="category-stats mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Total Products:</span>
                                    <span class="fw-bold fs-4" style="color: #6B4423;">{{ $artisanBreads->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="text-muted">Total Stock:</span>
                                    <span class="badge bg-primary">{{ $artisanBreads->sum('stock') }} units</span>
                                </div>
                            </div>

                            <div class="products-list">
                                @forelse($artisanBreads->take(3) as $product)
                                    <div class="product-mini">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div class="product-mini-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="product-mini-details">
                                            <p class="product-mini-name">{{ Str::limit($product->name, 20) }}</p>
                                            <p class="product-mini-stock">
                                                <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                    Stock: {{ $product->stock }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-mini-price">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-category">
                                        <i class="bi bi-inbox"></i>
                                        <p>No products yet</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($artisanBreads->count() > 3)
                                <div class="text-center mt-3">
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                                        View All ({{ $artisanBreads->count() }})
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sweet Pastries -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm border-0 category-card">
                        <div class="card-header" style="background-color: #8B5A3C; color: white;">
                            <h5 class="mb-0">
                                <i class="bi bi-archive"></i> Sweet Pastries
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="category-stats mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Total Products:</span>
                                    <span class="fw-bold fs-4" style="color: #8B5A3C;">{{ $sweetPastries->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="text-muted">Total Stock:</span>
                                    <span class="badge bg-primary">{{ $sweetPastries->sum('stock') }} units</span>
                                </div>
                            </div>

                            <div class="products-list">
                                @forelse($sweetPastries->take(3) as $product)
                                    <div class="product-mini">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div class="product-mini-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="product-mini-details">
                                            <p class="product-mini-name">{{ Str::limit($product->name, 20) }}</p>
                                            <p class="product-mini-stock">
                                                <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                    Stock: {{ $product->stock }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-mini-price">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-category">
                                        <i class="bi bi-inbox"></i>
                                        <p>No products yet</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($sweetPastries->count() > 3)
                                <div class="text-center mt-3">
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                                        View All ({{ $sweetPastries->count() }})
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Signature Cakes -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm border-0 category-card">
                        <div class="card-header" style="background-color: #D4A574; color: white;">
                            <h5 class="mb-0">
                                <i class="bi bi-archive"></i> Signature Cakes
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="category-stats mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Total Products:</span>
                                    <span class="fw-bold fs-4" style="color: #D4A574;">{{ $signatureCakes->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="text-muted">Total Stock:</span>
                                    <span class="badge bg-primary">{{ $signatureCakes->sum('stock') }} units</span>
                                </div>
                            </div>

                            <div class="products-list">
                                @forelse($signatureCakes->take(3) as $product)
                                    <div class="product-mini">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div class="product-mini-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="product-mini-details">
                                            <p class="product-mini-name">{{ Str::limit($product->name, 20) }}</p>
                                            <p class="product-mini-stock">
                                                <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                    Stock: {{ $product->stock }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-mini-price">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-category">
                                        <i class="bi bi-inbox"></i>
                                        <p>No products yet</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($signatureCakes->count() > 3)
                                <div class="text-center mt-3">
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                                        View All ({{ $signatureCakes->count() }})
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


    <!-- Styles -->
    <style>
        :root {
            --primary-brown: #6B4423;
            --secondary-brown: #8B5A3C;
            --light-cream: #F5F5DC;
            --accent-orange: #D4A574;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }



        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }



        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 15px;
        }



        .stat-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-brown);
            margin: 0;
            line-height: 1;
        }

        .stat-badge {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Category Cards */
        .category-card {
            border-radius: 15px;
            transition: all 0.3s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .category-stats {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
        }

        /* Product Mini */
        .products-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .product-mini {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 10px;
            background: #f8f9fa;
            transition: all 0.2s;
        }

        .product-mini:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .product-mini img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-mini-placeholder {
            width: 50px;
            height: 50px;
            background: #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
        }

        .product-mini-details {
            flex: 1;
        }

        .product-mini-name {
            font-weight: 600;
            margin: 0;
            color: var(--primary-brown);
            font-size: 0.9rem;
        }

        .product-mini-stock {
            margin: 5px 0 0 0;
            font-size: 0.8rem;
        }

        .product-mini-price {
            font-weight: bold;
            color: var(--primary-brown);
            font-size: 1.1rem;
        }

        .empty-category {
            text-align: center;
            padding: 40px 20px;
            color: #adb5bd;
        }

        .empty-category i {
            font-size: 3rem;
        }

        /* Quick Actions */
        .quick-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            text-decoration: none;
            color: var(--primary-brown);
            transition: all 0.3s;
        }

        .quick-action:hover {
            border-color: var(--primary-brown);
            background: var(--light-cream);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .quick-action i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .quick-action span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Card */
        .card {
            border-radius: 15px;
        }

        /* Scrollbar */
        .products-list::-webkit-scrollbar {
            width: 6px;
        }

        .products-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .products-list::-webkit-scrollbar-thumb {
            background: var(--accent-orange);
            border-radius: 10px;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</x-app-layout>
