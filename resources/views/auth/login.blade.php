<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Green Mart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .login-header {
            background-color: #28a745;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-login {
            background-color: #28a745;
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="card login-card">
                <div class="login-header">
                    <i class="fas fa-leaf fa-3x mb-3"></i>
                    <h3 class="mb-0">Green Mart Login</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email Address
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1"></i> Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-login w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>

                        <!-- Links -->
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted text-decoration-none">
                                    Forgot your password?
                                </a>
                                                        @endif
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <p class="mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-success mt-2">
                                <i class="fas fa-user-plus me-2"></i> Create Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-white text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toast Notification -->
    <script>
        window.onload = function() {
            var toastHTML = `
                <div class="toast align-items-center text-secondary bg-white border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Tim Pengembangan:
                            <br> Email: admin@gmail.com
                            <br> Password: password
                        </div>
                        <button type="button" class="btn-close btn-close-secondary me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', toastHTML);

            // Initialize and show the toast
            var toastElement = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        };
    </script>
</body>
</html>