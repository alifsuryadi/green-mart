<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Green Mart - Product Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --green-primary: #28a745;
            --green-dark: #1e7e34;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--green-primary) 0%, var(--green-dark) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,.05) 10px,
                rgba(255,255,255,.05) 20px
            );
            animation: slide 20s linear infinite;
        }
        
        @keyframes slide {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .stats-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        
        .stat-card {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--green-primary);
        }
        
        .cta-section {
            background-color: #343a40;
            color: white;
            padding: 80px 0;
        }
        
        .btn-custom {
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        .btn-success-custom {
            background-color: #66bb6a; /* Lebih terang dari hijau sebelumnya */
            color: white;
        }

    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-leaf text-success"></i> Green Mart
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#stats">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link btn btn-success-custom btn-success text-white ms-2"  href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success ms-2" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success-custom btn-success text-white ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Welcome to Green Mart Product Management</h1>
                    <p class="lead mb-4">Manage your products efficiently with our comprehensive dashboard system. Built for Green Mart's modern needs.</p>
                    <div class="d-flex gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-custom">
                                <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light btn-custom">
                                <i class="fas fa-rocket me-2"></i> Get Started
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="images/logo.jpeg" 
                         alt="Green Mart" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Key Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="text-success mb-3">
                                <i class="fas fa-box fa-3x"></i>
                            </div>
                            <h4>Product Management</h4>
                            <p class="text-muted">Manage up to 5 products per user with dynamic listing and auto-increment numbering.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="text-success mb-3">
                                <i class="fas fa-tags fa-3x"></i>
                            </div>
                            <h4>Category System</h4>
                            <p class="text-muted">Add up to 3 categories per product with descriptions and organized structure.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="text-success mb-3">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                            <h4>Image Upload</h4>
                            <p class="text-muted">Upload multiple images per category with support for JPG, JPEG, and PNG formats.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="stats" class="stats-section">
        <div class="container">
            <h2 class="text-center mb-5">Platform Statistics</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <div class="stat-number">{{ $stats['total_users'] }}</div>
                        <p class="text-muted mb-0">Registered Users</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-box fa-3x text-success mb-3"></i>
                        <div class="stat-number">{{ $stats['total_products'] }}</div>
                        <p class="text-muted mb-0">Total Products</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-tags fa-3x text-success mb-3"></i>
                        <div class="stat-number">{{ $stats['total_categories'] }}</div>
                        <p class="text-muted mb-0">Categories</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-image fa-3x text-success mb-3"></i>
                        <div class="stat-number">{{ $stats['total_images'] }}</div>
                        <p class="text-muted mb-0">Product Images</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">About Green Mart System</h2>
                    <p class="lead">A comprehensive product management system designed specifically for Green Mart's needs.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>User-friendly Interface:</strong> Easy to navigate dashboard with sidebar navigation
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Secure Authentication:</strong> Built-in login and registration system
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Responsive Design:</strong> Works perfectly on all devices
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Real-time Updates:</strong> Dynamic content management without page refresh
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Development Team</h4>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-circle p-3 me-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <strong>Julia</strong><br>
                                <small class="text-muted">Project Manager</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-3 me-3">
                                <i class="fas fa-code"></i>
                            </div>
                            <div>
                                <strong>Robert & John</strong><br>
                                <small class="text-muted">Backend & Frontend Developer</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle p-3 me-3">
                                <i class="fas fa-bug"></i>
                            </div>
                            <div>
                                <strong>Marshall</strong><br>
                                <small class="text-muted">Quality Assurance</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Join Green Mart's product management system today and streamline your business operations.</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-success btn-custom">
                    <i class="fas fa-user-plus me-2"></i> Create Your Account
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-success btn-custom">
                    <i class="fas fa-arrow-right me-2"></i> Continue to Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Green Mart. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>