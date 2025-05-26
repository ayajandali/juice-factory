<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Juice Factory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Juice Factory</h1>
            <p>Fresh & Natural Juice Delivered to Your Doorstep</p>
            <a href="#products" class="btn">Shop Now</a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <h2>Our Juices</h2>
            <div class="product-grid">
                <!-- Example product -->
                <div class="product-card">
                    <img src="{{ asset('images/juice1.jpg') }}" alt="Juice 1">
                    <h3>Orange Juice</h3>
                    <p>$4.99</p>
                    <a href="#" class="btn">Add to Cart</a>
                </div>
                <!-- Repeat for more products -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Juice Factory. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>