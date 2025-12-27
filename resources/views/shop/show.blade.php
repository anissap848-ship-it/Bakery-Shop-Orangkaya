<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Bakery Shop</title>
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

        .product-main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .product-category {
            background-color: var(--accent-orange);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            display: inline-block;
        }

        .btn-primary-custom {
            background-color: var(--primary-brown);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--secondary-brown);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        .quantity-input {
            width: 120px;
            text-align: center;
            font-size: 1.2rem;
            border: 2px solid var(--primary-brown);
            border-radius: 10px;
        }

        .btn-quantity {
            background-color: var(--primary-brown);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
        }

        .product-info-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .related-product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .related-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .related-product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
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
                        <a class="nav-link fw-semibold" href="{{ route('shop.index') }}" style="color: #6B4423;">SHOP</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('dashboard') }}" style="color: #6B4423;">
                                DASHBOARD
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

    <!-- Product Detail -->
    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="/" style="color: #6B4423;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" style="color: #6B4423;">Shop</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-6">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="product-main-image">
                @else
                    <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=800"
                         alt="{{ $product->name }}"
                         class="product-main-image">
                @endif

                <!-- Product Features -->
                <div class="row mt-4">
                    <div class="col-4 text-center">
                        <div class="p-3 bg-white rounded">
                            <i class="bi bi-heart-pulse fs-3 mb-2" style="color: #6B4423;"></i>
                            <p class="mb-0 small fw-semibold">Fresh Daily</p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-3 bg-white rounded">
                            <i class="bi bi-shield-check fs-3 mb-2" style="color: #6B4423;"></i>
                            <p class="mb-0 small fw-semibold">Quality Guaranteed</p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-3 bg-white rounded">
                            <i class="bi bi-truck fs-3 mb-2" style="color: #6B4423;"></i>
                            <p class="mb-0 small fw-semibold">Fast Delivery</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info-box">
                    <!-- Category -->
                    <span class="product-category mb-3">{{ $product->category }}</span>

                    <!-- Product Name -->
                    <h1 class="display-5 fw-bold mt-3 mb-3" style="color: #6B4423;">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="mb-4">
                        <h2 class="h1 fw-bold mb-2" style="color: #6B4423;">
                            ${{ number_format($product->price, 2) }}
                        </h2>
                        <p class="text-muted">
                            (Rp {{ number_format($product->price * 15000, 0, ',', '.') }})
                        </p>
                    </div>

                    <!-- Stock Status -->
                    <div class="alert {{ $product->stock > 10 ? 'alert-success' : ($product->stock > 0 ? 'alert-warning' : 'alert-danger') }}" role="alert">
                        <i class="bi bi-box-seam me-2"></i>
                        @if($product->stock > 10)
                            <strong>In Stock</strong> - {{ $product->stock }} units available
                        @elseif($product->stock > 0)
                            <strong>Low Stock!</strong> - Only {{ $product->stock }} units left
                        @else
                            <strong>Out of Stock</strong>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Description</h5>
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Quantity Selector -->
                    @if($product->stock > 0)
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Quantity</h5>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn-quantity" onclick="decreaseQty()">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number"
                                       id="quantity"
                                       class="form-control quantity-input"
                                       value="1"
                                       min="1"
                                       max="{{ $product->stock }}">
                                <button class="btn-quantity" onclick="increaseQty()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <div class="d-grid gap-2 mb-3">
                            <button class="btn btn-primary-custom" onclick="addToCart()">
                                <i class="bi bi-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                            <button class="btn btn-outline-dark rounded-pill">
                                <i class="bi bi-heart me-2"></i>
                                Add to Wishlist
                            </button>
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            This product is currently out of stock. Please check back later!
                        </div>
                    @endif

                    <!-- Product Meta -->
                    <div class="border-top pt-4 mt-4">
                        <p class="mb-2">
                            <strong>Category:</strong>
                            <a href="{{ route('shop.index', ['category' => $product->category]) }}"
                               style="color: #6B4423;">
                                {{ $product->category }}
                            </a>
                        </p>
                        <p class="mb-2">
                            <strong>SKU:</strong> BKRY-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-5 pt-5">
                <h2 class="text-center fw-bold mb-5" style="color: #6B4423;">
                    You May Also Like
                </h2>

                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-md-3">
                            <div class="related-product-card">
                                <a href="{{ route('shop.show', $related) }}" class="text-decoration-none">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}"
                                             alt="{{ $related->name }}"
                                             class="related-product-img">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400"
                                             alt="{{ $related->name }}"
                                             class="related-product-img">
                                    @endif
                                    <div class="p-3">
                                        <h6 class="fw-bold mb-2" style="color: #6B4423;">
                                            {{ $related->name }}
                                        </h6>
                                        <p class="h6 fw-bold mb-0" style="color: #6B4423;">
                                            ${{ number_format($related->price, 2) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Bakery Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const maxStock = {{ $product->stock }};

        function increaseQty() {
            const qtyInput = document.getElementById('quantity');
            let currentQty = parseInt(qtyInput.value);
            if (currentQty < maxStock) {
                qtyInput.value = currentQty + 1;
            }
        }

        function decreaseQty() {
            const qtyInput = document.getElementById('quantity');
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        }

        function addToCart() {
            const qty = document.getElementById('quantity').value;
            alert(`Added ${qty} item(s) to cart! (Feature coming soon)`);
            // TODO: Implement cart functionality
        }
    </script>
</body>
</html>
