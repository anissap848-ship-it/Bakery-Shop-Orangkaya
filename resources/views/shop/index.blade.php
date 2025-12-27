<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Bakery Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-brown: #6B4423;
            --secondary-brown: #8B5A3C;
            --light-cream: #F5F5DC;
            --accent-orange: #D4A574;
        }

        body {
            background-color: var(--light-cream);
        }

        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .hero-shop {
            background: linear-gradient(rgba(107, 68, 35, 0.8), rgba(107, 68, 35, 0.8)),
                        url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200') center/cover;
            padding: 80px 0;
            color: white;
            text-align: center;
        }

        .filter-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 100px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-category {
            background-color: var(--accent-orange);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .btn-primary-custom {
            background-color: var(--primary-brown);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--secondary-brown);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .filter-btn {
            border: 2px solid var(--primary-brown);
            color: var(--primary-brown);
            background: white;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--primary-brown);
            color: white;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="/" style="color: #6B4423;">
                🥐 BAKERY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="/" style="color: #6B4423;">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold active" href="{{ route('shop.index') }}" style="color: #6B4423;">SHOP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#about" style="color: #6B4423;">ABOUT</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('dashboard') }}" style="color: #6B4423;">
                                <i class="bi bi-person-circle"></i> DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: #6B4423;">
                                <i class="bi bi-cart fs-5"></i>
                                <span class="badge bg-danger">0</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('login') }}" style="color: #6B4423;">LOGIN</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-shop">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Our Products</h1>
            <p class="lead">Freshly baked daily with love and premium ingredients</p>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb breadcrumb-custom justify-content-center">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                    <li class="breadcrumb-item text-white active">Shop</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Shop Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 mb-4">
                <div class="filter-card">
                    <h5 class="fw-bold mb-4" style="color: #6B4423;">
                        <i class="bi bi-funnel"></i> Filter Products
                    </h5>

                    <form action="{{ route('shop.index') }}" method="GET">
                        <!-- Search -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Search</label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       placeholder="Search products..."
                                       value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Sort By</label>
                            <select class="form-select" name="sort" onchange="this.form.submit()">
                                <option value="">Latest</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                    Name: A-Z
                                </option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i> Reset Filters
                        </a>
                    </form>

                    <!-- Quick Categories -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Quick Categories</h6>
                        <div class="d-grid gap-2">
                            @foreach($categories as $cat)
                                <a href="{{ route('shop.index', ['category' => $cat]) }}"
                                   class="btn btn-sm filter-btn {{ request('category') == $cat ? 'active' : '' }}">
                                    @if($cat == 'Artisan Breads') 🍞
                                    @elseif($cat == 'Sweet Pastries') 🥐
                                    @elseif($cat == 'Custom Cakes') 🎂
                                    @endif
                                    {{ $cat }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Results Info -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">
                            Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}
                            of {{ $products->total() }} products
                        </h5>
                        @if(request('search'))
                            <p class="text-muted mb-0">
                                Search results for: <strong>"{{ request('search') }}"</strong>
                            </p>
                        @endif
                        @if(request('category'))
                            <p class="text-muted mb-0">
                                Category: <strong>{{ request('category') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Products -->
                <div class="row g-4">
                    @forelse($products as $product)
                        <div class="col-md-4">
                            <div class="product-card">
                                <a href="{{ route('shop.show', $product) }}" class="text-decoration-none">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="product-img">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400"
                                             alt="{{ $product->name }}"
                                             class="product-img">
                                    @endif
                                </a>

                                <div class="p-3 flex-grow-1 d-flex flex-column">
                                    <span class="product-category mb-2">{{ $product->category }}</span>

                                    <a href="{{ route('shop.show', $product) }}"
                                       class="text-decoration-none text-dark">
                                        <h5 class="fw-bold mb-2" style="color: #6B4423;">
                                            {{ $product->name }}
                                        </h5>
                                    </a>

                                    <p class="text-muted mb-3 small">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="h5 mb-0 fw-bold" style="color: #6B4423;">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                            @if($product->stock > 0)
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </div>

                                        @if($product->stock > 0)
                                            <button class="btn btn-primary-custom w-100"
                                                    onclick="addToCart({{ $product->id }})">
                                                <i class="bi bi-cart-plus"></i> Add to Cart
                                            </button>
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-search display-1 text-muted"></i>
                                <h4 class="mt-4 text-muted">No products found</h4>
                                <p class="text-muted">Try adjusting your search or filters</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary-custom mt-3">
                                    View All Products
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="fw-bold mb-3">🥐 BAKERY SHOP</h4>
                    <p>Your trusted bakery since 2025. Freshly baked with love every day.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="text-white text-decoration-none">Shop</a></li>
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Follow Us</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-light">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Bakery Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addToCart(productId) {
            alert('Product added to cart! (Feature coming soon)');
            // TODO: Implement cart functionality
        }
    </script>
</body>
</html>
