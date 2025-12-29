<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Shop - Freshly Baked, Just for You!</title>
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
            font-family: 'Georgia', serif;
        }

        /* Navbar */
        .navbar-custom {
            background-color: var(--light-cream);
            box-shadow: none;
            border-bottom: 1px solid rgba(107, 68, 35, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem !important;
            font-weight: bold;
            color: var(--primary-brown) !important;
            letter-spacing: 2px;
        }

        .nav-link {
            color: var(--primary-brown) !important;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        /* Hero Section - FIXED! */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)),
                        url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1600') center/cover;
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
            color: white;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: bold;
            color: #F5DEB3 !important;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            line-height: 1.2;
            margin-bottom: 0;
        }

        .hero-subtitle {
            font-size: 4rem;
            font-weight: bold;
            color: #F5DEB3 !important;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            margin-bottom: 2rem;
        }

        .hero-subtitle-small {
            font-size: 1.3rem;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .est-text {
            font-size: 1rem;
            color: var(--accent-orange) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            letter-spacing: 3px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Buttons */
        .btn-primary-custom {
            background-color: var(--primary-brown);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            background-color: var(--secondary-brown);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid white;
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            background: transparent;
            transition: all 0.3s;
        }

        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-brown);
        }

        /* Why Choose Us */
        .section-title {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-brown);
            margin-bottom: 1rem;
            text-align: center;
        }

        .section-divider {
            width: 100px;
            height: 4px;
            background-color: var(--accent-orange);
            margin: 0 auto 3rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 2rem;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .feature-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 2rem;
            border: 5px solid var(--light-cream);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-brown);
            margin-bottom: 1rem;
        }

        .feature-text {
            color: #666;
            line-height: 1.8;
        }

        /* CTA Section */
        .cta-section {
            background-color: var(--primary-brown);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .cta-text {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        .btn-cta {
            background: white;
            color: var(--primary-brown);
            padding: 18px 50px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1.1rem;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s;
        }

        .btn-cta:hover {
            background: var(--light-cream);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        /* Footer */
        .footer-custom {
            background-color: var(--primary-brown);
            color: white;
            padding: 50px 0 30px;
        }

        .social-icon {
            font-size: 2rem;
            color: white;
            transition: all 0.3s;
            display: inline-block;
        }

        .social-icon:hover {
            color: var(--accent-orange);
            transform: translateY(-5px);
        }

        .footer-text {
            opacity: 0.9;
        }

        /* Product Card Placeholder */
        .product-section {
            background: white;
            padding: 80px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                🥐 BAKERY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">ABOUT US</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-person-circle"></i> DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-cart fs-5"></i>
                                <span class="badge bg-danger">0</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
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

    <!-- Hero Section - FIXED! -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <p class="est-text">EST. 2025 • ARTISAN BAKERY</p>
                    <h1 class="hero-title">Freshly Baked,</h1>
                    <h2 class="hero-subtitle">Just for You!</h2>
                    <p class="hero-subtitle-small mb-5">
                        Nikmati kehangatan roti artisan dan pastry manis yang dibuat<br>dengan bahan premium setiap pagi.
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="#menu" class="btn btn-primary-custom">LIHAT MENU</a>
                        <a href="#contact" class="btn btn-outline-custom">LOKASI KAMI</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="about" class="py-5">
        <div class="container my-5">
            <h2 class="section-title">🍪 Why Choose Us?</h2>
            <div class="section-divider"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400"
                             alt="Organic Ingredients"
                             class="feature-img">
                        <h3 class="feature-title">Organic Ingredients</h3>
                        <p class="feature-text">
                            Kami hanya menggunakan tepung gandum organik dan bahan alami tanpa pengawet.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400"
                             alt="Baked Fresh Daily"
                             class="feature-img">
                        <h3 class="feature-title">Baked Fresh Daily</h3>
                        <p class="feature-text">
                            Oven kami menyala sejak jam 4 pagi untuk memastikan roti terhangat buat kamu.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400"
                             alt="Made with Love"
                             class="feature-img">
                        <h3 class="feature-title">Made with Love</h3>
                        <p class="feature-text">
                            Setiap adonan diuleni dengan sepenuh hati oleh chef berpengalaman kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Lapar? Pesan Sekarang!</h2>
            <p class="cta-text">
                Pilih roti favoritmu lewat menu online kami dan kami antar langsung ke depan pintu rumahmu.
            </p>
            <a href="{{ route('shop.index') }}" class="btn btn-cta">
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
                    <p class="footer-text">Your trusted bakery since 2025. Freshly baked with love every day.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-white text-decoration-none footer-text">Home</a></li>
                        <li><a href="#menu" class="text-white text-decoration-none footer-text">Menu</a></li>
                        <li><a href="#about" class="text-white text-decoration-none footer-text">About Us</a></li>
                        <li><a href="#contact" class="text-white text-decoration-none footer-text">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Follow Us</h5>
                    <div class="d-flex gap-4">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-light mt-4 mb-4">
            <div class="text-center">
                <p class="mb-0 footer-text">&copy; 2025 Bakery Shop Premium. Dibuat dengan ❤️</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
