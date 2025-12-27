<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Shop - Freshly Baked, Just for You!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            background: linear-gradient(rgba(107, 68, 35, 0.05), rgba(107, 68, 35, 0.05)),
                        url('https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=1200') center/cover;
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: bold;
            color: #6B4423;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
        }

        .hero-subtitle {
            font-size: 2rem;
            color: #2C1810;
            margin-bottom: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 2rem;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .feature-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1.5rem;
        }

        .cta-section {
            background-color: #6B4423;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-bottom: 2rem;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-category {
            background-color: #D4A574;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 0.5rem;
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
                        <a class="nav-link fw-semibold" href="#home" style="color: #6B4423;">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#menu" style="color: #6B4423;">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#about" style="color: #6B4423;">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#contact" style="color: #6B4423;">CONTACT US</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('dashboard') }}" style="color: #6B4423;">
                                <i class="bi bi-person-circle"></i> DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}" style="color: #6B4423;">
                                <i class="bi bi-cart fs-5"></i>
                                <span class="badge bg-danger">0</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('login') }}" style="color: #6B4423;">LOGIN</a>
                        </li>
                    @endauth
                    <li class="nav-item ms-3">
                        @auth
                            <a href="{{ route('products.index') }}" class="btn btn-primary-custom">MANAGE PRODUCTS</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary-custom">ORDER NOW</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="text-uppercase text-muted fw-semibold mb-2" style="letter-spacing: 2px;">
                        EST. 2025 • ARTISAN BAKERY
                    </p>
                    <h1 class="hero-title">Freshly Baked,</h1>
                    <h2 class="hero-subtitle">Just for You!</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem;">
                        Nikmati kehangatan roti artisan dan pastry manis yang dibuat dengan bahan premium setiap pagi.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#menu" class="btn btn-primary-custom btn-lg">LIHAT MENU</a>
                        <a href="#contact" class="btn btn-outline-dark btn-lg rounded-pill">LOKASI KAMI</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="section-title mt-5">🍪 Why Choose Us?</h2>
            <p class="text-center text-muted mb-5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
            </p>

            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400"
                             alt="Organic Ingredients"
                             class="feature-img">
                        <h3 class="h4 fw-bold mb-3" style="color: #6B4423;">Organic Ingredients</h3>
                        <p class="text-muted">
                            Kami hanya menggunakan tepung gandum organik dan bahan alami tanpa pengawet.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400"
                             alt="Baked Fresh Daily"
                             class="feature-img">
                        <h3 class="h4 fw-bold mb-3" style="color: #6B4423;">Baked Fresh Daily</h3>
                        <p class="text-muted">
                            Oven kami menyala sejak jam 4 pagi untuk memastikan roti terhangat buat kamu.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400"
                             alt="Made with Love"
                             class="feature-img">
                        <h3 class="h4 fw-bold mb-3" style="color: #6B4423;">Made with Love</h3>
                        <p class="text-muted">
                            Setiap adonan diuleni dengan sepenuh hati oleh chef berpengalaman kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Products -->
    <section id="menu" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">🥖 Our Fresh Products</h2>
            <p class="text-center text-muted mb-5">
                Discover our delicious selection of freshly baked goods
            </p>

            <!-- Category Filter -->
            <div class="text-center mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-dark rounded-pill me-2 active">All</button>
                    <button type="button" class="btn btn-outline-dark rounded-pill me-2">Artisan Breads</button>
                    <button type="button" class="btn btn-outline-dark rounded-pill me-2">Sweet Pastries</button>
                    <button type="button" class="btn btn-outline-dark rounded-pill">Custom Cakes</button>
                </div>
            </div>

            <div class="row">
                @forelse($products ?? [] as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="product-img">
                            @else
                                <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400"
                                     alt="{{ $product->name }}"
                                     class="product-img">
                            @endif
                            <div class="p-4">
                                <span class="product-category">{{ $product->category }}</span>
                                <h3 class="h5 fw-bold mb-2" style="color: #6B4423;">{{ $product->name }}</h3>
                                <p class="text-muted mb-3">{{ Str::limit($product->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h4 mb-0 fw-bold" style="color: #6B4423;">
                                        Rp {{ number_format($product->price * 15000, 0, ',', '.') }}
                                    </span>
                                    <span class="badge bg-success">Stock: {{ $product->stock }}</span>
                                </div>
                                <button class="btn btn-primary-custom w-100 mt-3">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No products available yet. Please check back soon!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('shop.index') }}" class="btn btn-primary-custom btn-lg">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="display-5 fw-bold mb-3">Lapar? Pesan Sekarang!</h2>
            <p class="lead mb-4">
                Pilih roti favoritmu lewat menu online kami dan kami antar langsung ke depan pintu rumahmu.
            </p>
            <a href="{{ route('shop.index') }}" class="btn btn-light btn-lg rounded-pill px-5">
                BUKA MENU
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-custom" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="fw-bold mb-3">🥐 BAKERY SHOP</h4>
                    <p>Your trusted bakery since 2025. Freshly baked with love every day.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="#menu" class="text-white text-decoration-none">Menu</a></li>
                        <li><a href="#about" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
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
                <p class="mb-0">&copy; {{ date('Y') }} Bakery Shop Premium. Dibuat dengan ❤️</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</body>
</html>
