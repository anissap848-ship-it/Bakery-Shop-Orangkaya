<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, serif;
            background-color: #F5F5DC;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #F5F5DC;
            padding: 20px 0;
            border-bottom: 1px solid rgba(107, 68, 35, 0.1);
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: #6B4423 !important;
            letter-spacing: 3px;
        }

        .croissant-icon {
            font-size: 2.5rem;
            margin-right: 15px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1600') center/cover;
            height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero-content {
            max-width: 1000px;
            padding: 40px;
        }

        .hero-title {
            font-size: 5rem;
            font-weight: bold;
            color: #F5DEB3;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        /* Buttons */
        .btn-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-login {
            background-color: #6B4423;
            color: white;
            border: none;
            padding: 18px 80px;
            border-radius: 50px;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: lowercase;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-login:hover {
            background-color: #8B5A3C;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            color: white;
        }

        .btn-register {
            background-color: transparent;
            color: white;
            border: 3px solid white;
            padding: 15px 60px;
            border-radius: 50px;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: lowercase;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: white;
            color: #6B4423;
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .btn-login, .btn-register {
                padding: 15px 50px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center">
                <span class="croissant-icon">🥐</span>
                BAKERY SHOP
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Freshly Baked, Just for You!</h1>
            <p class="hero-subtitle">
                Discover our delicious selection of artisan breads and pastries,<br>
                made with love and premium ingredients every day.
            </p>

            <div class="btn-container">
                <a href="{{ route('login') }}" class="btn btn-login">
                    login
                </a>
                <a href="{{ route('register') }}" class="btn btn-register">
                    register
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
