<!--Header ra footer ko faile to link-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stickify')</title>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Your custom CSS files -->
    <link rel="stylesheet" href="{{ asset('css/homecss/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homecss/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homecss/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homecss/howitworks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homecss/contact.css') }}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
</head>
<body>
    <!-- Navbar/Header -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-inner">
                <div class="navbar-brand">
                    <i class="bi bi-sticky brand-icon"></i>
                    <span class="brand-title" id="home">Stickify</span>
                </div>
                <div class="navbar-links header">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#how-it-works" class="nav-link">How It Works</a>
                    <a href="#contact" class="nav-link">Contact</a>
                    <a href="{{ route('login') }}" class="nav-link">Log In</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
        @yield('login')
        @yield('register')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-inner">
                <div class="footer-logo">
                    <i class="bi bi-sticky"></i>
                    <span>Stickify</span>
                    <p>Pin It, Keep It, Recall It</p>
                </div>
                <nav class="footer-nav">
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#how-it-works">How It Works</a>
                    <a href="#contact">Contact</a>
                    <a href="{{ route('login') }}">Log In</a>
                </nav>
            </div>
        </div>
        <div class="footer-container">
            <p>&copy; 2025 Stickify. All rights reserved.</p>
            <p>For Minor-II</p>
        </div>
    </footer>
</body>
</html>

<script src="./login.js"></script>
<script src="./signup.js"></script>
